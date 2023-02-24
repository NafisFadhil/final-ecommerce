@extends('account.layout')

@php
		$inputs = [
			[
				'type' => 'text',
				'name' => 'nama',
				'label' => 'Nama Produk',
				'placeholder' => 'Masukkan Nama Produk',
				'value' => old('product_name')
			],
			[
				'type' => 'number',
				'name' => 'harga',
				'label' => 'Harga Produk',
				'placeholder' => 'Masukkan Harga Produk',
				'value' => old('product_price')
			],
		]
@endphp

@section('main')
	<div class="main-title">
		<h1>Tambah Produk</h1>
		<p>Tambah Produk</p>
	</div>
	<form class="d-flex flex-column profile" action="/account/products" method="POST">
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
				<label class="form-label font-bold" for="category_id">Pilih Kateegori</label>
					@foreach ($categories as $category)
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="category_id[]" value="{{ $category->id }}" id="">
							<label class="form-check-label" for="">
								{{ $category->nama }}
							</label>
						</div>
					@endforeach
				@error('category_id')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
			<div class="flex flex-col input-group mb-3">
				<label class="form-label font-bold" for="product_desc">Deskripsi Produk</label>
				<textarea class="form-control w-100" name="desk" id="product_desc" cols="30" rows="10" placeholder="Masukkan Deskripsi Produk">{{ old('product_desc') }}</textarea>
				@error('product_desc')
					<div class="text-danger">{{ $message }}</div>
				@enderror
			</div>
			<button type="submit" onclick="return confirm('Anda yakin?')" class="p-2.5 rounded-lg bg-yellow-400 mx-auto">Simpan &#10140;</button>
	</form>
@endsection