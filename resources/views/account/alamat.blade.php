@extends('account.layout')

@section('main')
	<div class="main-title">
		<h1>Alamat</h1>
		<p>Daftar Alamat</p>
	</div>

	<a href="/account/address/create" class="btn btn-warning text-white fw-bold">Tambah Alamat</a>

	<section>
		<table class="table text-center mt-4">
			<tr class="text-white bg-yellow-400">
				<th>No</th>
				<th>Alamat</th>
				<th>Aksi</th>
			</tr>
			@foreach ($addresses as $address)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td class="text-center">
						{{ $address->alamat }}
					</td>
					<td>
						<form  id="remove-{{ $loop->iteration }}" action="/account/address/{{ $address->id }}" method="POST">
							@method('delete')
							@csrf
							<a href="/account/address/{{ $address->id }}/edit" class="text-white btn btn-warning">Edit</a>
							<button type="submit" onclick="return confirm('Anda yakin ?')" class="btn btn-danger bg-red-600">Hapus</button>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
	</section>
@endsection
