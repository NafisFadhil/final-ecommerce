@extends('partials.main')

@section('content')

<div id="carouselId" class="carousel slide" data-bs-ride="carousel">
	<ol class="carousel-indicators">
		@foreach ($banner as $b)
			<li data-bs-target="#carouselId" data-bs-slide-to="{{ $loop->index }}" class="active" aria-current="true"></li>
		@endforeach
	</ol>
	<div class="carousel-inner" role="listbox">
		@foreach ($banner as $b)
			<div class="carousel-item banner active">
				<img src="{{ asset('storage/'.$b->gambar) }}" class="img-fluid object-center object-cover w-100 d-block" alt="First slide">
			</div>
		@endforeach
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
		</button>
</div>
<section class="d-flex flex-column my-5">
	<h1 class="font-bold mb-3 title">Produk Teratas</h1>
	<div class="d-flex flex-wrap justify-content-center align-items-center m-auto my-4 gap-4 products">
		@foreach ($featured as $product)
			<div class="d-flex flex-column basis-1/5 shadow-md product bg-white">
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
	<a href="/product?sort=featured" class="d-flex font-bold mx-auto btn text-white btn-warning">Lebih Banyak</a>
</section>
<section class="d-flex flex-column my-5">
	<h1 class="font-bold mb-3 title">Produk Terbaru</h1>
	<div class="d-flex flex-wrap justify-content-center align-items-center m-auto my-4 gap-4 products">
		@foreach ($latest as $product)
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
	<a href="/product?sort=featured" class="d-flex mx-auto btn text-white font-bold btn-warning">Lebih Banyak</a>
</section>
<section class="d-flex flex-column my-5">
	<h1 class="title mb-4">Testimoni</h1>
	<div id="testimoni" class="carousel slide container carousel-dark" data-bs-ride="carousel">
		<div class="carousel-inner" role="listbox">
			@if (count($testi) < 1)
				<div class="carousel-item active text-center p-4">
					<p class="fw-bold">Belum ada data</p>
				</div>
			@else
				@foreach ($testi as $t)
					<div class="carousel-item active text-center p-4">
						<div class="mb-3">{{ $t->konten }}</div>
						<p class="fw-bold">- {{ $t->user->name }} -</p>
					</div>
				@endforeach
			@endif
		</div>
		@if (count($testi) > 1)
			<button class="carousel-control-prev" type="button" data-bs-target="#testimoni" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#testimoni" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		@endif
	</div>
</section>

@endsection