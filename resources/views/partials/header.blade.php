@if (session('success'))
	<div class="flex text-white justify-between alert fixed top-0 right-0 p-4 m-6 rounded-lg max-w-xs bg-green-600 success">
		<p>{{ session('success') }}</p>
		<a href="javascript:void(0)" onclick="this.parentNode.remove()"><i class="bi bi-x-lg"></i></a>
	</div>
@endif
@if (session('error'))
	<div class="flex text-white justify-between alert fixed top-0 right-0 p-4 m-6 rounded-lg max-w-xs bg-red-600 danger">
		<p>{{ session('error') }}</p>
		<a href="javascript:void(0)" onclick="this.parentNode.remove()"><i class="bi bi-x-lg"></i></a>
	</div>
@endif

<nav class="flex justify-between fixed top-0 left-0 right-0 items-center bg-white shadow navbar">
	<a href="/" class="text-4xl font-black nav-logo">N<span class="text-yellow-400">Store</span>.</a>

	<div class="nav-search m-auto flex-1">
		<form class="flex justify-center" action="/product">
		<div class="flex items-stretch w-full">
			<input type="text" class="outline-none border rounded-l-md w-full p-2" name="search" id="search" placeholder="Cari produk" value="{{ request('search') }}">
			<button type="submit" class="px-3 bg-yellow-400 font-semibold rounded-tr-md rounded-br-md hover:brightness-75 transition-all"><i class="bi bi-search"></i></button>
		</div>
		</form>
	</div>

	<a href="/account/cart" class="relative">
		<i class="bi bi-cart text-dark text-3xl"></i>
		@if (auth()->check())
			@if (ModelHelper::countCart() > 0)
				<span class="absolute top-0 start-100 translate-middle badge rounded-full bg-red-500">
					{{ ModelHelper::countCart() }}
				</span>
			@endif
		@endif
	</a>

	<div class="vr text-dark w-1"></div>

	<div class="nav-menu">
		@if (!auth()->check())
			<a class="p-2.5 font-bold {{ request()->is('register') ? 'active' : '' }}" href="/register">Daftar</a>
			<a class="p-2.5 font-bold {{ request()->is('login') ? 'active' : '' }}" href="/login">Masuk</a>
		@endif
		@if (auth()->check())
			<a class="flex flex-row justify-center gap-2 items-center p-2.5 font-bold {{ request()->is('account*') ? 'active' : '' }}" href="/account">
				<img class="max-h-8 aspect-square object-cover rounded-full" src="{{ asset('storage/'. auth()->user()->profile_pic) }}" alt="">
				<span>{{ auth()->user()->username }}</span>
			</a>
		@endif
	</div>


	<a href="javascript:void(0)" id="toggle">&#9776;</a>
</nav>