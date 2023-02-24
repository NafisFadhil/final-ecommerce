@extends('account.layout')

@section('main')
	<div class="main-title">
		<h1>Testimoni</h1>
		<p>Testimoni saya</p>
	</div>

	<a href="/account/testimoni/create" class="btn btn-warning text-white fw-bold">Tambah Testimoni</a>

	<section class="mt-4">
		<table class="table text-center">
			<tr class="bg-yellow-400 text-white">
				<th>Testimoni</th>
				<th>Aksi</th>
			</tr>
			@foreach ($testi as $test)
				<tr>
					<td>
						{{ $test->konten }}
					</td>
					<td>
						<form  id="remove-{{ $loop->iteration }}" action="/account/testimoni/{{ $test->id }}" method="POST">
							@method('delete')
							@csrf
							<a href="/account/testimoni/{{ $test->id }}/edit" class="text-white btn btn-warning">Edit</a>
							<button type="submit" onclick="return confirm('Anda yakin ?')" class="btn btn-danger bg-red-600">Hapus</button>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
	</section>
@endsection
