@extends('account.layout')

@php
		$inputs = [
			[
				'type' => 'file',
				'name' => 'gambar',
				'label' => 'Gambar Banner',
				'placeholder' => '',
				'value' => ''
			],
			[
				'type' => 'number',
				'name' => 'posisi',
				'label' => 'Posisi',
				'placeholder' => 'Masukkan Posisi',
				'value' => old('posisi')
			],
		]
@endphp

@section('main')
	<div class="main-title">
		<h1>Tambah Banner</h1>
		<p>Tambah Banner</p>
	</div>
	<form class="flex flex-col profile" action="/account/banners" method="POST" enctype="multipart/form-data">
		@csrf
			@foreach ($inputs as $input)	
				<div class="d-flex flex-column input-group mb-3">
					<label class="font-bold mb-2" for="{{ $input['name'] }}">{{ $input['label'] }}</label>
					<input class="form-control w-100" type="{{ $input['type'] }}" name="{{ $input['name'] }}" id="{{ $input['name'] }}" placeholder="{{ $input['placeholder'] }}" value="{{ $input['value'] }}">
					@error($input['name'])
						<div class="text-danger">{{ $message }}</div>
					@enderror
				</div>
			@endforeach
			<button type="submit" onclick="return confirm('Anda Yakin ?')" class="p-2.5 rounded-lg bg-yellow-400  mx-auto">Simpan &#10140;</button>
	</form>
@endsection