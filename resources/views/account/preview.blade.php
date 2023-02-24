@extends('account.layout')

@section('main')
	<div class="main-title">
		<h1>Preview</h1>
		<p>Daftar Preview</p>
	</div>

	<a href="/account/previews/{{ $previews[0]->product->id ?? $product->id }}/create" class="btn btn-warning text-white fw-bold">Tambah Preview</a>

	<section class="cart mt-4">
		<table class="table">
			<tr class="bg-yellow-400 text-white">
				<th>No</th>
				<th>Gambar</th>
				<th>Aksi</th>
			</tr>
			@foreach ($previews as $preview)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>
						<div class="d-flex cart-info">
							<img class="img-fluid" src="{{ asset('storage/'.$preview->gambar) }}" alt="">
						</div>
					</td>
					<td>
						<form  id="remove-{{ $loop->iteration }}" action="/account/previews/{{ $preview->produk->id }}/{{ $preview->id }}" method="POST">
							@method('delete')
							@csrf
							<a href="/account/previews/{{ $preview->produk->id }}/{{ $preview->id }}/edit" class="text-white btn btn-warning">Edit</a>
							<button type="submit" onclick="return confirm('Anda yakin ingin menghapus ini ?')" class="btn btn-danger bg-red-600">Hapus</button>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
	</section>
@endsection
