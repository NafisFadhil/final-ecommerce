<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ecommerce</title>

	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/media.css') }}">
	<link rel="stylesheet" href="{{ asset('bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
</head>
<body class="bg-slate-200">
	<div class="flex flex-col h-screen">
		@include('partials.header')

		<div class="nav-padder"></div>

		<main class="flex-1">
			@yield('content')
		</main>

		@include('partials.footer')
	</div>

	<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('js/script.js') }}"></script>
	@yield('script')
</body>
</html>