<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class ReportController extends Controller
{
  public function index()
	{
		$data = Produk::all();
		$order = Pesanan::where('status', 'diterima')->get();
	
		$sold = 0;
		foreach ($data as $item) {
			$sold += $item->terjual;
		}

		$income = 0;
		foreach ($order as $or) {
			$income += $or->tagihan;
		}

		return view('account.report', [
			'sold' => $sold,
			'income' => $income
		]);
	}
}
