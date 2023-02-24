@extends('account.layout')

@php
		$inputs = [
			[
				'type' => 'text',
				'name' => 'name',
				'label' => 'Nama',
				'placeholder' => 'Enter Name',
				'value' => auth()->user()->name
			],
			[
				'type' => 'text',
				'name' => 'username',
				'label' => 'Nama Pengguna',
				'placeholder' => 'Enter Username',
				'value' => auth()->user()->username
			],
			[
				'type' => 'email',
				'name' => 'email',
				'label' => 'Email',
				'placeholder' => 'Enter Email',
				'value' => auth()->user()->email
			],
			[
				'type' => 'number',
				'name' => 'phone',
				'label' => 'Nomor Telepon',
				'placeholder' => 'Enter Phone Number',
				'value' => auth()->user()->phone
			],
			[	
				'type' => 'password',
				'name' => 'password',
				'label' => 'Ganti Kata Sandi',
				'placeholder' => 'Enter New Password',
				'value' => ''
			],
		]
@endphp

@section('main')
	<div class="py-2 main-title">
		<h1>Profil Saya</h1>
		<p></p>
	</div>
	<div class="my-2 profile-pic">
		<img class="max-h-28 aspect-square object-cover rounded-full" src="{{ asset('storage/'. auth()->user()->profile_pic) }}" alt="">
	</div>
	<form action="" method="POST" class="flex flex-col" enctype="multipart/form-data">
			@csrf
			<div class="mb-3">
				<label for="profile_pic" class="form-label font-bold">Ganti Foto Profil</label>
				<input type="file" class="form-control" name="profile_pic" id="profile_pic" placeholder="">
			</div>
				@foreach ($inputs as $input)
					<div class="form-floating mb-2">
						<input class="form-control @error($input['name']) is-invalid @enderror" type="{{ $input['type'] }}" id="{{ $input['name'] }}" name="{{ $input['name'] }}" placeholder="{{ $input['placeholder'] }}" value="{{ $input['value'] }}">
						<label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
					</div>
					@error($input['name'])
						<div class="text-danger mb-3">{{ $message }}</div>
					@enderror
				@endforeach
			<div class="mb-3">
				<input type="checkbox" id="showPw">
				<label for="showPw">Tampilkan Kata Sandi</label>
			</div>
			<button type="submit" onclick="return confirm('Anda yakin ?')" class="p-2.5 rounded-lg bg-yellow-400 mx-auto fw-bold">Simpan &#10140;</button>
	</form>

@endsection

@section('scripts')
	<script src="{{ asset('js/auth.js') }}"></script>
@endsection