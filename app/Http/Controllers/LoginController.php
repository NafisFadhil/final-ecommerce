<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
	{
		return view('login');
	}

	public function auth(Request $request)
	{
		$validData = $request->validate([
			'payload' => 'required',
			'password' => 'required|min:8'
		]);

		if(Auth::attempt(['email' => $validData['payload'], 'password' => $validData['password']])) {
			$request->session()->regenerate();

			return redirect('/account')->with('success', 'Berhasil masuk');
		} else if (Auth::attempt(['phone' => $validData['payload'], 'password' => $validData['password']])) {
			$request->session()->regenerate();

			return redirect('/account')->with('success', 'Berhasil masuk');
		}

		return back()->with('error', 'Gagal masuk');
	}

	public function logout(Request $request)
	{
		Auth::logout($request);

		$request->session()->invalidate();

		$request->session()->regenerate();

		return redirect('/')->with('success', 'Berhasil keluar');
	}
}
