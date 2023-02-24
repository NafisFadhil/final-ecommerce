@extends('account.layout')

@php
		$inputs = [
			[
				'type' => 'text',
				'name' => 'nama',
				'label' => 'Nama Produk',
				'placeholder' => 'Masukkan Nama Produk',
				'value' => $product->nama ?? old('nama')
			],
			[
				'type' => 'number',
				'name' => 'harga',
				'label' => 'Harga Produk',
				'placeholder' => 'Masukkan Harga Produk',
				'value' => $product->harga ?? old('harga')
			],
		]
@endphp

@section('main')
	<div class="main-title">
		<h1>Edit Produk</h1>
		<p>Edit Produk</p>
	</div>
	<form class="d-flex flex-column profile" action="/account/products/{{ $product->id }}" method="POST">
		@method('put')
		@csrf
			@foreach ($inputs as $input)	
				<div class="d-flex flex-column input-group mb-3">
					<label class="font-bold" for="{{ $input['name'] }}">{{ $input['label'] }}</label>
					<input class="form-control w-100" type="{{ $input['type'] }}" name="{{ $input['name'] }}" id="{{ $input['name'] }}" placeholder="{{ $input['placeholder'] }}" value="{{ $input['value'] }}">
					@error($input['name'])
						<div class="text-danger">{{ $message }}</div>
					@enderror
				</div>
			@endforeach
			<div class="d-flex flex-column input-group mb-3">
				<label class="form-label font-bold" for="category_id">Pilih Kategori</label>
					<?php
						$category_id = [];

						foreach ($product->kategori as $category) {
							$category_id[] = $category->id;
						}
					?>
					@foreach ($categories as $category)
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="category_id[]" value="{{ $category->id }}" id=""  @checked(in_array($category->id, $category_id))>
							<label class="form-check-label" for="">
								{{ $category->nama }}
							</label>
						</div>
					@endforeach
				@error('category_id')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="d-flex flex-column input-group mb-3">
				<label class="font-bold form-label" for="product_desc">Deskripsi Produk</label>
				<textarea class="form-control w-100" name="desk" id="product_desc" cols="30" rows="10">{{ old('product_desc') }}</textarea>
				@error('product_desc')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="flex justify-between">
				<button type="submit" onclick="return confirm('Anda yakin ?')" class="p-2.5 rounded-lg bg-yellow-400 text-white mx-auto">Simpan &#10140;</button>
				<a href="/account/previews/{{ $product->id }}" class="p-2.5 rounded-lg bg-yellow-400 text-white mx-auto">Edit Preview &#10140;</a>
			</div>
	</form>
@endsection