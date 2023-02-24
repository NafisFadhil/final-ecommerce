@extends('account.layout')

@php
		$inputs = [
			[
				'type' => 'file',
				'name' => 'gambar',
				'label' => 'Gambar',
				'placeholder' => 'Upload Banner',
				'value' => ''
			],
		]
@endphp

@section('main')
	<div class="main-title">
		<h1>Tambah Preview</h1>
		<p>Tambah preview</p>
	</div>
	<form class="d-flex flex-column profile" action="/account/previews/{{ $product->id }}" method="POST" enctype="multipart/form-data">
		@csrf
			@foreach ($inputs as $input)	
				<div class="d-flex flex-column input-group mb-3">
					<label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
					<input class="form-control w-100" type="{{ $input['type'] }}" name="{{ $input['name'] }}" id="{{ $input['name'] }}" placeholder="{{ $input['placeholder'] }}" value="{{ $input['value'] }}">
					@error($input['name'])
						<div class="text-danger">{{ $message }}</div>
					@enderror
				</div>
			@endforeach
			<button type="submit" onclick="return confirm('Anda yakin ?')" class="p-2.5 rounded-lg bg-yellow-400 mx-auto">Simpan &#10140;</button>
	</form>
@endsection