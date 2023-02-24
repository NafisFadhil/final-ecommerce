@extends('account.layout')

@section('main')
	<div class="main-title">
		<h1>Produk</h1>
		<p>Daftar Produk</p>
	</div>

	<a href="/account/products/create" class="btn btn-warning fw-bold">Tambah Produk</a>

	<section class="mt-4">
		<table class="table">
			<tr class="bg-yellow-400">
				<th>No</th>
				<th>Produk</th>
				<th>Kategori</th>
				<th>Aksi</th>
			</tr>
			@foreach ($products as $product)
				<tr>
					<td>{{ $loop->iteration + ($products->firstItem() - 1) }}</td>
					<td>
						<div class="flex gap-2 cart-info">
							<img class="img-fluid" src="{{ asset('storage/'.$product->preview[0]->gambar) }}" alt="">
							<div class="">
								<h2 class="font-bold">{{ $product->nama }}</h2>
								<p><span id="price-{{ $loop->iteration }}">{{ App\Helpers\GeneralHelper::toRupiah($product->harga) }}</span></p>
							</div>
						</div>
					</td>
					<td>
						@foreach ($product->kategori as $cat)
							<li>{{ $cat->nama }}</li>
						@endforeach
					</td>
					<td>
						<form  id="remove-{{ $loop->iteration }}" action="/account/products/{{ $product->id }}" method="POST">
							@method('delete')
							@csrf
							<a href="/account/products/{{ $product->id }}/edit" class="btn btn-warning">Edit</a>
							<button type="submit" onclick="return confirm('Anda yakin ingin menghapus ini ?')" class="btn btn-danger bg-red-600">Hapus</button>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
		<div class="mt-4">
			{{ $products->links() }}
		</div>
	</section>
@endsection
