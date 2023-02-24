@extends('account.layout')

@section('main')
	<div class="main-title">
		<h1>Pesanan</h1>
		<p>Daftar Pesanan</p>
	</div>
	<section>
		<table class="table text-center mt-5">
			<tr class="text-black bg-yellow-400">
				<th>No</th>
				<th>Produk</th>
				<th>Total Tagihan</th>
				@if (auth()->user()->is_admin)
					<th>Aksi</th>
				@endif
			</tr>
			@foreach ($orders as $order)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td class="flex flex-col">
						@foreach ($order->produk as $product)
						<div class="flex justify-between mt-2">
								<div class="flex flex-col cart-info">
									<h5 class="m-0">{{ ModelHelper::getProductName($product['produk_id']) }}</h5>
									<p class="m-0">{{ GeneralHelper::toRupiah(ModelHelper::getProductPrice($product['produk_id'])) }} x {{ $product['jumlah'] }}</p>
								</div>
								@if (!auth()->user()->is_admin)
									@if ($order->status == 'pending')
										Admin sedang memproses pesananmu
									@elseif ($order->status == 'ditolak') 
										Maaf, pesanan anda ditolak
									@elseif(($order->status == 'diterima') && !ModelHelper::isRate($product['produk_id'], $order->id))
										Pesanan sudah sampai, silahkan beri penilaian
										<button type="button" class="p-2.5 rounded-lg text-white font-bold bg-blue-500" data-bs-toggle="modal" data-bs-target="#modalId-{{ $loop->iteration }}">
											Nilai
										</button>
									@elseif(ModelHelper::isRate($product['produk_id'], $order->id))
										Dinilai
									@endif
								@endif
							
							<!-- Modal -->
							<div class="modal fade" id="modalId-{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="modalTitleId">Nilai Pesanan</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form action="/rate/{{ $product['produk_id'] }}" method="post">
												<input type="hidden" name="pesanan_id" value="{{ $order->id }}">
											@csrf
											<div class="container-fluid">
												<div class="mb-3">
													<select class="form-select" name="rating" id="rating">
														<option selected>Pilih Rating</option>
														<option value="1">&starf;</option>
														<option value="2">&starf;&starf;</option>
														<option value="3">&starf;&starf;&starf;</option>
														<option value="4">&starf;&starf;&starf;&starf;</option>
														<option value="5">&starf;&starf;&starf;&starf;&starf;</option>
													</select>
												</div>
												<div class="text-start mb-3">
													<label for="" class="form-label max-w-max font-bold">Komentar</label>
													<textarea class="form-control" name="komentar" id="komentar" rows="3" placeholder="Tambahkan Komentar"></textarea>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="p-2.5 rounded-lg bg-slate-600 text-white" data-bs-dismiss="modal">Close</button>
											<button type="submit" class="p-2.5 rounded-lg bg-yellow-400 text-white">Submit</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</td>
					<td>
						{{ GeneralHelper::toRupiah($order->tagihan) }}
					</td>
					@if (auth()->user()->is_admin)
						<td>
							<!-- Button trigger modal -->
							<div class="flex gap-2 w-full justify-center">
								<button type="button" class="p-2.5 rounded-lg text-white font-bold bg-blue-500" data-bs-toggle="modal" data-bs-target="#detail">
									Detail
								</button>
								<form action="/send" method="post">
									@csrf
									<input type="hidden" name="order_id" value="{{ $order->id }}">
									<button class="p-2.5 rounded-lg text-white font-bold bg-green-600" type="submit">Kirim</button>
								</form>
								<form action="/tolak" method="post">
									@csrf
									<input type="hidden" name="order_id" value="{{ $order->id }}">
									<button class="p-2.5 rounded-lg text-white font-bold bg-red-600" type="submit">Tolak</button>
								</form>
							</div>
							
							<!-- Modal -->
							<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title font-bold" id="modalTitleId">Detail Pesanan</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
											</div>
										<div class="modal-body">
											<div class="container-fluid">
												<div class="mb-3 text-start">
													<label for="" class="form-label font-bold">Pembeli</label>
													<input type="text" class="form-control" name="" id="" value="{{ $order->user->name }}" placeholder="" readonly>
												</div>
												<div class="mb-3 text-start">
													<label for="" class="form-label font-bold">Alamat</label>
													<input type="text" class="form-control" name="" id="" value="{{ $order->alamat->alamat }}" placeholder="" readonly>
												</div>
												<div class="mb-3 text-start">
													<label for="" class="form-label font-bold">Metode Pembayaran</label>
													<input type="text" class="form-control" name="" id="" value="{{ $order->metode_pembayaran }}" placeholder="" readonly>
												</div>
												<div class="mb-3 text-start">
													<label for="" class="form-label font-bold">Courier</label>
													<input type="text" class="form-control" name="" id="" value="{{ $order->kurir->nama }}" placeholder="" readonly>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="p-2.5 rounded-lg bg-slate-600 text-white" data-bs-dismiss="modal">Tutup</button>
										</div>
									</div>
								</div>
							</div>
						</td>
					@endif
				</tr>
			@endforeach
		</table>
	</section>
@endsection
