<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Produk::latest()->paginate(10);
			
			return view('account.product', [
				'products' => $data
			]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
				$categories = Kategori::all();
        return view('account.add-product', [
					'categories' => $categories
				]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validData = $request->validate([
				'nama' => 'required',
				'harga' => 'required',
				'desk' => 'required',
				'category_id' => 'required',
			]);

			$product = Produk::create($validData);

			$category = Kategori::find($validData['category_id']);

			$product->kategori()->attach($category);

			return redirect('/account/previews/'. $product->id)->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $product)
    {
			$categories = Kategori::all();
        return view('account.edit-product', [
					'product' => $product,
					'categories' => $categories
				]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $product)
    {
      
			$validData = $request->validate([
				'nama' => 'required',
				'harga' => 'required',
				'desk' => 'required',
				'category_id' => 'required',
			]);

			$category = Kategori::find($validData['category_id']);
			
			$product->kategori()->detach();

			$product->update($validData);


			$product->kategori()->attach($category);

			return redirect('/account/products')->with('success', 'Produk berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $product)
    {
			foreach ($product->preview as $preview) {
        Storage::delete($preview->gambar);
			}

			$product->delete();

			return redirect('/account/products')->with('success', 'Produk berhasil dihapus');
    }
}
