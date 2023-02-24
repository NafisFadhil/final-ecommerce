@extends('account.layout')

@section('main')
	<div class="main-title">
		<h1>Laporan</h1>
		<p>Laporan Penjualan</p>
	</div>
	<table class="table text-start">
		<tr>
			<th>Produk Terjual</th>
			<td>:</td>
			<td><span class="font-bold text-red-600">{{ $sold }}</span> Produk Terjual</td>
		</tr>
		<tr>
			<th>Jumlah Pendapatan</th>
			<td>:</td>
			<td><span class="font-bold ">{{ GeneralHelper::toRupiah($income) }}</span></td>
		</tr>
	</table>
@endsection
