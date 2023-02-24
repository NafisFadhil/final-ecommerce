<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RateController extends Controller
{
    public function rate(Request $request, Produk $product)
		{
			$validator = Validator::make($request->all(), [
				'rating' => 'required',
				'komentar' => 'required'
			]);

			if($validator->fails()) {
				return back()->with('error', 'Rating dan komentar wajib diisi');
			}

			if(is_null($product->rating)) {
				$product->update([
					'rating' => [intval($request->rating)]
				]);
			} else {
				$product->update([
					'rating' => [...$product->rating, intval($request->rating)]
				]);
			}

			Komentar::create([
					'user_id' => auth()->user()->id,
					'produk_id' => $product->id,
					'komentar' => $request->komentar,
					'pesanan_id' => $request->pesanan_id
				]
			);

			return redirect('/account/orders')->with('success', 'Penilaian diterima');
		}
}
