<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
	public function index()
	{
		if(!auth()->user()->is_admin) {
			$data = Pesanan::where('user_id', auth()->user()->id)->latest()->get();
		} else {
			$data = Pesanan::where('status', 'pending')->latest()->get();
		}

		return view('account.order', [
			'orders' => $data
		]);
	}

	public function send(Request $request)
	{
		$order = Pesanan::find($request->order_id);

		$order->update([
			'status' => 'diterima'
		]);

		return redirect('/account/send')->with('success', 'Pesanan dikirim');
	}

	public function allSend()
	{
		
		$data = Pesanan::where('status', 'diterima')->latest()->get();

		return view('account.send', [
			'orders' => $data
		]);
	}

	public function reject(Request $request)
	{
		$order = Pesanan::find($request->order_id);

		$order->update([
			'status' => 'ditolak'
		]);

		return redirect('/account/orders')->with('success', 'Pesanan ditolak');
	}
}
