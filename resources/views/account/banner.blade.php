@extends('account.layout')

@section('main')
	<div class="main-title">
		<h1>Banner</h1>
		<p>Daftar Banner</p>
	</div>

	<a href="/account/banners/create" class="btn btn-warning fw-bold">Tambah Banner</a>

	<section>
		<table class="table text-center mt-4">
			<tr class=" bg-yellow-400">
				<th>No</th>
				<th>Banner</th>
				<th>Posisi</th>
				<th>Aksi</th>
			</tr>
			@foreach ($banners as $banner)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td class="text-center">
						<div class="cart-info">
							<img src="{{ asset('storage/'.$banner->gambar) }}" alt="">
						</div>
					</td>
					<td>{{ $banner->posisi }}</td>
					<td>
						<form  id="remove-{{ $loop->iteration }}" action="/account/banners/{{ $banner->id }}" method="POST">
							@method('delete')
							@csrf
							<a href="/account/banners/{{ $banner->id }}/edit" class=" btn btn-warning">Edit</a>
							<button type="submit" onclick="return confirm('Anda yakin ?')" class="btn btn-danger bg-red-600">Hapus</button>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
	</section>
@endsection
