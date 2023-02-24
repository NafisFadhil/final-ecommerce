<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
		{
			$product = Produk::filter(request(['sort', 'search', 'category']))->paginate(8)->withQueryString();
			$categories = Kategori::all();

			return view('product', [
				'products' => $product,
				'categories' => $categories
			]);
		}

		public function show(Produk $produk)
		{
			$products = Produk::where('id', '!=', $produk->id)->limit(4)->get();

			return view('detail', [
				'product' => $produk,
				'products' => $products
			]);
		}

		public function buy(Request $request)
		{
			$cart = Keranjang::where('user_id', auth()->user()->id)->where('produk_id', $request->product_id)->first();

			if(Keranjang::where('user_id', auth()->user()->id)->where('produk_id', $request->product_id)->exists()) {
				$cart->update([
					'jumlah' => $cart->jumlah + 1, 
				]);
			} else {
				Keranjang::create([
					'user_id' => auth()->user()->id,
					'produk_id' => $request->product_id,
				]);
			}

			return redirect('/account/cart')->with('success', 'Produk ditambahkan ke keranjang');
		}
}
