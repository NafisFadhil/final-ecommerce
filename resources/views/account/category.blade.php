@extends('account.layout')

@section('main')
	<div class="main-title">
		<h1>Kategori</h1>
		<p>Daftar Kategori</p>
	</div>

	<a href="/account/categories/create" class="btn btn-warning fw-bold">Tambah Kategori</a>

	<section>
		<table class="table text-center mt-4">
			<tr class="bg-yellow-400">
				<th>No</th>
				<th>Kategori</th>
				<th>Aksi</th>
			</tr>
			@foreach ($categories as $category)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td class="text-center">
						{{ $category->nama }}
					</td>
					<td>
						<form  id="remove-{{ $loop->iteration }}" action="/account/categories/{{ $category->id }}" method="POST">
							@method('delete')
							@csrf
							<a href="/account/categories/{{ $category->id }}/edit" class=" btn btn-warning">Edit</a>
							<button type="submit" onclick="return confirm('Anda yakin ?')" class="btn btn-danger bg-red-600">Hapus</button>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
	</section>
@endsection
