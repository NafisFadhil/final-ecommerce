@extends('account.layout')

@php
		$inputs = [
			[
				'type' => 'text',
				'name' => 'konten',
				'label' => 'Testimoni',
				'placeholder' => 'Masukkan Testimoni',
				'value' => old('alamat')
			],
		]
@endphp

@section('main')
	<div class="main-title pb-2">
		<h1>Tambah Testimoni</h1>
		<p>Tambah testimoni</p>
	</div>
	<form class="d-flex flex-column profile" action="/account/testimoni" method="POST">
		@csrf
			@foreach ($inputs as $input)	
				<div class="d-flex flex-column input-group mb-3">
					<label class="font-bold mb-2" for="{{ $input['name'] }}">{{ $input['label'] }}</label>
					<textarea class="form-control w-100" name="konten" id="konten" cols="30" rows="10" placeholder="{{ $input['placeholder'] }}">{{ old('konten') }}</textarea>
					@error($input['name'])
						<div class="text-danger">{{ $message }}</div>
					@enderror
				</div>
			@endforeach
			<button type="submit" onclick="return confirm('Anda yakin ?')" class="p-2.5 rounded-lg bg-yellow-400 mx-auto">Simpan &#10140;</button>
	</form>
@endsection