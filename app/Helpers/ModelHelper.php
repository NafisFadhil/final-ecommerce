<?php 

namespace App\Helpers;

use App\Models\Keranjang;
use App\Models\Komentar;
use App\Models\Pesanan;
use App\Models\Produk;

class ModelHelper
{
	public static function countCart()
	{
		$count = Keranjang::where('user_id', auth()->user()->id)->count();

		return $count < 100 ? $count : '99+';
	}

	public static function getRating(array $rating)
	{
		if(empty($rating)) {
			return 0;
		}
		$rate = 0;
		foreach ($rating as $r) {
			$rate += $r;
		}

		$result = $rate / count($rating);

		return intval(floor($result));
	}

	public static function getRatingById($product_id)
	{
		$product = Produk::find($product_id);


		return \App\Helpers\ModelHelper::getRating($product->rating);
	}

	public static function getProductName($id)
	{
		$product = Produk::find($id);

		return $product->nama;
	}
	public static function getProductPrice($id)
	{
		$product = Produk::find($id);

		return $product->harga;
	}

	public static function isRate($produk_id, $pesanan_id)
	{
		// $rate = Komentar::where('produk_id', $produk_id)->where('pesanan_id', $pesanan_id)->first();

		if(!Komentar::where('produk_id', $produk_id)->where('pesanan_id', $pesanan_id)->exists()) {
			return false;
		}else{
			return true;
		}
	}

	public static function countNeedSend()
	{
		$count = Pesanan::where('status', 'pending')->count();

		return $count;
	}
}