<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
		{
			return view('account.profile');
		}

		public function update(Request $request)
	{
		$validData = $request->validate([
			'name' => 'required',
			'username' => 'required|unique:users,username,'.auth()->user()->id,
			'email' => 'required|unique:users,email,'.auth()->user()->id.'|email:dns',
			'phone' => 'required|unique:users,phone,'.auth()->user()->id,
			'profile_pic' => 'image'
		]);

		if($request->password) {
			$validData = $request->validate([
				'password' => 'min:8'
			]);
			$validData['password'] = Hash::make($validData['password']);
		}

		if($request->file('profile_pic')) {
			if(auth()->user()->profile_pic != 'profile_default.jpg'){
				Storage::delete(auth()->user()->profile_pic);
			}
			$validData['profile_pic'] = $request->file('profile_pic')->store('profile-pic');
		}

		User::find(auth()->user()->id)->update($validData);

		return redirect('/account')->with('success', 'Perubahan Disimpan');
	}
}
