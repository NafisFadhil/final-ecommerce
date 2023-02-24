<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Kurir;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeranjangController extends Controller
{
  public function index()
	{
		$courier = Kurir::all();
		$data = Keranjang::where('user_id', auth()->user()->id)->get();

		return view('account.cart', [
			'carts' => $data,
			'courier' => $courier
		]);
	}

	public function destroy(Keranjang $cart)
	{
		
		$cart->delete();

		return redirect('/account/cart')->with('success', 'Produk dihapus dari keranjang');
	}

	public function checkout(Request $request)
	{
		$validData = Validator::make($request->all(), [
			'alamat_id' => 'required',
			'produk' => 'required',
			'kurir_id' => 'required',
			'metode_pembayaran' => 'required',
			'tagihan' => 'required'
		]);

		if($validData->fails()) {
			return back()->with('error', 'Chekout gagal, pastikan data sudah benar');
		}

		$code = mt_rand(001,999);

		$validData = $validData->getData();

		$payload = [
			'alamat_id' => $validData['alamat_id'],
			'produk' => $validData['produk'],
			'user_id' => auth()->user()->id,
			'kurir_id' => $validData['kurir_id'],
			'tagihan' => $validData['tagihan'],
			'kode' => $code,
			'metode_pembayaran' => $validData['metode_pembayaran']
		];

		Pesanan::create($payload);

		$carts = [];
		$products = [];
		$quantity = [];
		foreach ($validData['produk'] as $product) 
		{
			if(isset($product['produk_id'])) {
				$carts[] = $product['cart_id'];
				$products[] = $product['produk_id'];
				$quantity[] = $product['jumlah'];
			}
		}
		
		foreach ($products as $key=>$p) {
			Produk::find($p)->update([
				'terjual' => Produk::find($p)->terjual + $quantity[$key]
			]);
		}
		Keranjang::destroy($carts);
		
		return redirect('/account/orders')->with('success', 'Checkout berhasil');
	}
}
