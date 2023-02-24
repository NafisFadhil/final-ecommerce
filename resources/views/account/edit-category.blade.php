@extends('account.layout')

@php
		$inputs = [
			[
				'type' => 'text',
				'name' => 'name',
				'label' => 'Kategori',
				'placeholder' => 'Masukkan Nama Kategori',
				'value' => $category->nama ?? old('nama')
			],
		]
@endphp

@section('main')
	<div class="main-title">
		<h1>Edit Kategori</h1>
		<p>Edit kategori</p>
	</div>
	<form class="d-flex flex-column profile" action="/account/categories/{{ $category->id }}" method="POST">
		@method('put')
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
			<button type="submit" onclick="return confirm('Are you sure to save this change?')" class="p-2.5 rounded-lg bg-yellow-400 text-white mx-auto">Simpan &#10140;</button>
	</form>
@endsection