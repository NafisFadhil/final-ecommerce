@extends('partials.main')

@section('content')
	<section class="d-flex overflow-auto mx-auto my-5 account">
		<div class="d-flex flex-column sidebar">
			<a class="p-2 font-bold hover:text-yellow-400 transition-all {{ request()->is('account') ? 'active' : '' }}" href="/account">Profil</a>

			@if (!auth()->user()->is_admin)
				<a class="p-2 font-bold hover:text-yellow-400 transition-all" href="/product">Mulai Belanja</a>
				<a class="p-2 font-bold hover:text-yellow-400 transition-all {{ request()->is('account/address*') ? 'active' : '' }}" href="/account/address">Alamat</a>
				<a class="p-2 font-bold hover:text-yellow-400 transition-all {{ request()->is('account/cart') ? 'active' : '' }}" href="/account/cart">Keranjang</a>
			@endif

			@if (auth()->user()->is_admin)
				<a class="p-2 font-bold hover:text-yellow-400 transition-all {{ request()->is('account/report') ? 'active' : '' }}" href="/account/report">Laporan</a>
			@endif

			<a class="p-2 font-bold hover:text-yellow-400 transition-all relative {{ request()->is('account/orders') ? 'active' : '' }}" href="/account/orders">Pesanan
				@if (auth()->user()->is_admin && ModelHelper::countNeedSend() > 0)
					<span class="absolute top-0 start-100 translate-middle badge rounded-full bg-red-500">
						{{ ModelHelper::countNeedSend() }}
					</span>
				@endif
			</a>
			
			@if (!auth()->user()->is_admin)
				<a class="p-2 font-bold hover:text-yellow-400 transition-all {{ request()->is('account/testimoni') ? 'active' : '' }}" href="/account/testimoni">Testimoni</a>	
			@endif

			@if (auth()->user()->is_admin)
				<a class="p-2 font-bold hover:text-yellow-400 transition-all {{ request()->is('account/send') ? 'active' : '' }}" href="/account/send">Pesanan Terkirim</a>
				<a class="p-2 font-bold hover:text-yellow-400 transition-all {{ request()->is('account/products*') || request()->is('account/previews*')  ? 'active' : '' }}" href="/account/products">Produk</a>
				<a class="p-2 font-bold hover:text-yellow-400 transition-all {{ request()->is('account/categories*') ? 'active' : '' }}" href="/account/categories">Kategori</a>
				<a class="p-2 font-bold hover:text-yellow-400 transition-all {{ request()->is('account/banners*') ? 'active' : '' }}" href="/account/banners">Banner</a>
			@endif

			<a class="p-2 font-bold hover:text-yellow-400 transition-all" href="/logout">Keluar &#10140;</a>
			<button class="btn btn-warning text-white fw-bold mw-100" onclick="collapsed()" id="close-side">Tutup</button>
		</div>

		<div class="main flex-1 p-7 overflow-auto bg-white">
			<button class="btn btn-warning text-dark fw-bold" onclick="collapsed()">&#9776;</button>
			@yield('main')
		</div>
	</section>
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

	@yield('scripts')
@endsection