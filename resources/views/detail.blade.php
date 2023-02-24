@extends('partials.main')

@section('content')
	<section class="flex flex-wrap gap-4 justify-center m-5 items-start details">
		<div id="carouselId" class="carousel slide basis-2/5" data-bs-ride="carousel">
			<div class="carousel-inner" role="listbox">
				@foreach ($product->preview as $prev)
					<div class="carousel-item active">
						<img src="{{ asset('storage/'. $prev->gambar) }}" class="w-100 d-block" alt="First slide">
					</div>
				@endforeach
			</div>
			@if (count($product->preview) > 1)
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
				
			@endif
		</div>
		<div class="flex flex-col basis-2/5 detail">
			<div class="detail-info">
				<h1 class="font-bold text-3xl">{{ $product->nama }}</h1>
				<p class="fw-bold text-3xl text-red-600">{{ GeneralHelper::toRupiah($product->harga) }}</p>
				@include('partials.rating')

			</div>
			<div class="detail-desc my-4">
				<h2 class="font-bold mb-2 text-2xl">Deskripsi</h2>
				<p>{{ $product->desk }}</p>
			</div>
			<form action="/buy" method="post">
				@csrf
				<input type="hidden" name="product_id" value="{{ $product->id }}">
				<button type="submit" class="mt-4 p-3 rounded-md bg-yellow-400 text-white fw-semibold">Masukkan Keranjang &#10140;</button>
			</form>
		</div>
	</section>

	<section>
		<div class="flex max-w-5xl m-auto flex-col">
			<h2 class="font-bold text-2xl mb-8">Komentar : </h2>
			@foreach ($product->komentar as $comment)
			<div class="flex gap-2 mt-4 border-b">
				<span>
					<img class="max-h-12 aspect-square object-cover rounded-full" src="{{ asset('storage/'. $comment->user->profile_pic) }}" alt="">
				</span>
				<div class="text-lg flex flex-col">
					<p class="font-bold">{{ $comment->user->name }}</p>
					<p>{{ $comment->komentar }}</p>
				</div>
			</div>
			@endforeach
		</div>
	</section>

	<section class="d-flex flex-column my-5">
		<h1 class="title">Produk Lainnya</h1>
		<div class="d-flex flex-wrap justify-content-center align-items-center m-auto my-4 gap-4 products">
		@foreach ($products as $product)
			<div class="d-flex flex-column basis-1/5 shadow-md  bg-white product">
				<a href="/product/{{ $product->id }}">
					<img src="{{ asset('storage/'. $product->preview[0]->gambar) }}" alt="" class="img-fluid">
					<div class="product-info p-2">
						<h2 class="font-bold text-2xl mb-3">{{ $product->nama }}</h2>
						@include('partials.rating')
						<p class="font-bold text-red-600">{{ GeneralHelper::toRupiah($product->harga) }}</p>
					</div>
				</a>
			</div>
		@endforeach
	</div>
		<a href="/product" class="d-flex mx-auto btn text-white btn-warning">Lebih Banyak</a>
	</section>
@endsection