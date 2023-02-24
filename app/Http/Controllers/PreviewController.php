<?php

namespace App\Http\Controllers;

use App\Models\Preview;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PreviewController extends Controller
{
	public function index(Produk $product)
	{
		$data = Preview::where('produk_id', $product->id)->latest()->get();

		return view('account.preview', [
			'previews' => $data,
			'product' => $product
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Produk $product)
	{
		return view('account.add-preview', [
			'product' => $product
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request, Produk $product)
	{
		$validData = $request->validate([
			'gambar' => 'image|required'
		]);

		$validData['gambar'] = $request->file('gambar')->store('previews');

		$validData['produk_id'] = $product->id;

		Preview::create($validData);

		return redirect('/account/previews/'. $product->id)->with('success', 'Berhasil');
	}

	/**
	 * Display the specified resource.
	 */
	// public function show(Preview $preview): Response
	// {
	//     //
	// }

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Produk $product, Preview $preview)
	{
		return view('account.edit-preview', [
			'product' => $product,
			'preview' => $preview
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Produk $product, Preview $preview)
	{
		$validData = $request->validate([
			'gambar' => 'image|required'
		]);

		$validData['gambar'] = $request->file('gambar')->store('previews');

		Storage::delete($preview->gambar);
		$validData['produk_id'] = $product->id;

		$preview->update($validData);

		return redirect('/account/previews/'. $product->id)->with('success', 'Berhasil');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Produk $product, Preview $preview)
	{
		Storage::delete($preview->gambar);

		$preview->delete();

		return redirect('/account/previews/'. $product->id)->with('success', 'Berhasil');
	}
}
