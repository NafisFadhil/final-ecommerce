@extends('partials.main')

@php
		$inputs = [
			[
				'type' => 'text',
				'name' => 'name',
				'label' => 'Nama',
				'placeholder' => 'Enter Name',
				'value' => old('name')
			],
			[
				'type' => 'text',
				'name' => 'username',
				'label' => 'Nama Pengguna',
				'placeholder' => 'Masukkan Username',
				'value' => old('username')
			],
			[
				'type' => 'email',
				'name' => 'email',
				'label' => 'Email',
				'placeholder' => 'Masukkan Email',
				'value' => old('email')
			],
			[
				'type' => 'number',
				'name' => 'phone',
				'label' => 'Nomor Telepon',
				'placeholder' => 'Masukkan Nomer Telepon',
				'value' => old('phone')
			],
			[
				'type' => 'password',
				'name' => 'password',
				'label' => 'Kata Sandi',
				'placeholder' => 'Masukkan Password',
				'value' => ''
			],
		]
@endphp

@section('content')
	<section class="login-page">
		<form action="" method="POST" class="needs-validation">
			<div class="d-flex flex-column mx-auto my-5 bg-white shadow rounded-md p-5 form-container">
				<h1 class="font-bold title mb-4">Daftar</h1>
				@csrf
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
				<button type="submit" class="p-2.5 rounded-lg bg-yellow-400 mx-auto fw-bold">Daftar &#10140;</button>
				<p class="text-center my-3">Sudah memiliki akun ? <a class="text-blue-700" href="/login">Masuk</a></p>
			</div>
		</form>
	</section>
@endsection

@section('script')
	<script src="{{ asset('js/auth.js') }}"></script>
@endsection