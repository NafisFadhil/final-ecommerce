@extends('account.layout')

@php
		$inputs = [
			[
				'type' => 'text',
				'name' => 'konten',
				'label' => 'Testimoni',
				'placeholder' => 'Masukkan Testimoni',
				'value' => $testi->konten ?? old('konten')
			],
		]
@endphp

@section('main')
	<div class="main-title pb-2">
		<h1>Edit Testimoni</h1>
		<p>Edit testimoni</p>
	</div>
	<form class="d-flex flex-column profile" action="/account/testimoni/{{ $testi->id }}" method="POST">
		@method('put')
		@csrf
			@foreach ($inputs as $input)	
				<div class="d-flex flex-column input-group mb-3">
					<label class="font-bold mb-2" for="{{ $input['name'] }}">{{ $input['label'] }}</label>
					<textarea class="form-control w-100" name="konten" id="konten" cols="30" rows="10" placeholder="{{ $input['placeholder'] }}">{{ $testi->konten ?? old('konten') }}</textarea>
					@error($input['name'])
						<div class="text-danger">{{ $message }}</div>
					@enderror
				</div>
			@endforeach
			<button type="submit" onclick="return confirm('Anda yakin ?')" class="p-2.5 rounded-lg bg-yellow-400 text-white mx-auto">Simpan &#10140;</button>
	</form>
@endsection