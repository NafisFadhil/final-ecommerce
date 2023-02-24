@extends('partials.main')

@section('content')
	<div class="d-flex justify-content-center">

		<div class="d-flex flex-column sidebar">
			<h2 class="title mb-3">Kategori</h2>
			<form id="cat-0" action="/product">
				@if (request('sort'))
					<input type="hidden" name="sort" value="{{ request('sort') }}">
				@endif
				@if (request('search'))
					<input type="hidden" name="search" value="{{ request('search') }}">
				@endif
				<input type="hidden" name="category" value="">
				<a class="{{ request('category') == '' ? 'fw-bold' : 'fw-normal' }}" href="javascript:void(0)" onclick="document.querySelector('#cat-0').submit()">Semua</a>
			</form>
			@foreach ($categories as $category)
				<form id="cat-{{ $loop->iteration }}" action="/product">
					@if (request('sort'))
						<input type="hidden" name="sort" value="{{ request('sort') }}">
					@endif
					@if (request('search'))
						<input type="hidden" name="search" value="{{ request('search') }}">
					@endif
					<input type="hidden" name="category" value="{{ $category->id }}">
					<a class="{{ request('category') == $category->id ? 'fw-bold' : 'fw-normal' }}" href="javascript:void(0)" onclick="document.querySelector('#cat-{{ $loop->iteration }}').submit()" >{{ $category->nama }}</a>
				</form>
			@endforeach
			<h2 class="title mb-3">Urutkan</h2>
			<form id="srt-1" action="/product">
				@if (request('sort'))
					<input type="hidden" name="category" value="{{ request('category') }}">
				@endif
				@if (request('search'))
					<input type="hidden" name="search" value="{{ request('search') }}">
				@endif
				<input type="hidden" name="sort" value="latest">
				<a class="{{ request('sort') == 'latest' ? 'fw-bold' : 'fw-normal' }}" href="javascript:void(0)" onclick="document.querySelector('#srt-1').submit()" >Terbaru</a>
			</form>
			<form id="srt-2" action="/product">
				@if (request('sort'))
					<input type="hidden" name="category" value="{{ request('category') }}">
				@endif
				@if (request('search'))
					<input type="hidden" name="search" value="{{ request('search') }}">
				@endif
				<input type="hidden" name="sort" value="featured">
				<a class="{{ request('sort') == 'featured' ? 'fw-bold' : 'fw-normal' }}" href="javascript:void(0)" onclick="document.querySelector('#srt-2').submit()" >Teratas</a>
			</form>
			<button class="btn btn-warning text-white fw-bold mw-100" onclick="collapsed()" id="close-side">Close</button>
		</div>
		<section class="d-flex flex-column m-5 w-100">
			<button class="btn btn-warning max-w-max text-white fw-bold" onclick="collapsed()">&#9776;</button>
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
			<div class="px-5">
				{{ $products->links() }}
			</div>
		</section>
	
	</div>
@endsection

@section('script')
	<script>
		var sidebar = document.querySelector('.sidebar');
		function collapsed() {
			sidebar.classList.toggle('collapsed');
		}

		function fixed() {
			sidebar.classList.toggle('fixed');
		}

		window.onresize = () => {
			if(window.innerWidth <= 600 && !sidebar.classList.contains('collapsed')) {
				collapsed()
			}
			if(window.innerWidth > 600 && sidebar.classList.contains('collapsed')) {
				collapsed()
			}

			if(window.innerWidth <= 600 && !sidebar.classList.contains('fixed')) {
				fixed()
			}
			if(window.innerWidth > 600 && sidebar.classList.contains('fixed')) {
				fixed()
			}
		}

		window.onload = window.onresize()
	</script>
@endsection