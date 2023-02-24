<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
	public function index()
	{
		return view('register');
	}

	public function store(Request $request)
	{
		$validData = $request->validate([
			'name' => 'required',
			'username' => 'required|unique:users,username',
			'email' => 'required|unique:users,email|email:dns',
			'phone' => 'required|unique:users,phone',
			'password' => 'required|min:8'
		]);

		$validData['password'] = Hash::make($validData['password']);

		User::create($validData);

		return redirect('/login')->with('success', 'Pendaftaran Berhasil');
	}
}
