@extends('account.layout')

@section('main')
	<div class="main-title">
		<h1>Keranjang Saya</h1>
		<p>Daftar Keranjang Saya</p>
	</div>
	<section>
		<table class="table">
			<tr class="text-center bg-yellow-400 text-white">
				<th>No</th>
				<th>Produk</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
				<th>#</th>
			</tr>
			@foreach ($carts as $cart)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td class="w-40">
						<div class="flex flex-col gap-2 cart-info">
							<img class="img-fluid" src="{{ asset('storage/'.$cart->produk->preview[0]->gambar) }}" alt="">
							<div class="">
								<h2 class="font-bold">{{ $cart->produk->nama }}</h2>
								<p><span id="price-{{ $loop->iteration }}">{{ App\Helpers\GeneralHelper::toRupiah($cart->produk->harga) }}</span></p>
							</div>
						</div>
					</td>
					<td class="text-center">
						<button id="minus-{{ $loop->iteration }}" class="fw-bold fs-4 p-2">&minus;</button>
						<input class="border-b-2 text-center w-10" type="number" id="quantity-{{ $loop->iteration }}" value="{{ $cart->jumlah }}" min="1" readonly>
						<button id="plus-{{ $loop->iteration }}" class="fw-bold fs-4 p-2">&plus;</button>
					</td>
					<td class="text-center"><span id="subtotal-{{ $loop->iteration }}"></span></td>
					<td>
						<form action="/account/cart/{{ $cart->id }}" method="post">
							@method('delete')
							@csrf
							<button type="submit" onclick="return confirm('Anda Yakin?')" class="btn fw-bold fs-4">&#10005;</button>
						</form>
					</td>
				</tr>
			@endforeach
		</table>
		@if (count($carts) >= 1)
			<button type="button" class="mt-4 p-2.5 rounded-lg bg-yellow-400 text-white fw-bold btn btn-warning" data-bs-toggle="modal" data-bs-target="#checkout-modal">
				Checkout
			</button>
		@endif
	</section>
	<div class="modal fade" id="checkout-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Checkout</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="/checkout" method="post">
					@csrf
					<div class="modal-body">
						<div class="mb-3">
							<label for="" class="form-label">Alamat</label>
							<select class="form-select form-select" name="alamat_id" id="">
								<option selected>Pilih Alamat</option>
								@foreach (auth()->user()->alamat as $addr)
									<option value="{{ $addr->id }}" selected>{{ $addr->alamat }}</option>		
								@endforeach
							</select>
						</div>
						<div class="mb-3">
							<label for="" class="form-label">Produk</label>
							@foreach ($carts as $cart)
								<div class="form-check">
									<input class="form-check-input pr" type="checkbox" name="produk[{{ $loop->index }}][produk_id]" value="{{ $cart->produk->id }}" id="check-{{ $loop->iteration }}">
									<input type="hidden" name="produk[{{ $loop->index }}][jumlah]" value="" id="cekQ-{{ $loop->iteration }}">
									<input type="hidden" name="produk[{{ $loop->index }}][cart_id]" value="{{ $cart->id }}" id="">
									<label class="form-check-label d-flex justify-content-between" for="">
										<p>
											{{ $cart->produk->nama }}
										</p>
										<p>
											<span id="cekP-{{ $loop->iteration }}"></span>
										</p>
									</label>
								</div>
							@endforeach
						</div>
						<div class="mb-3" id="courier">
							<label for="" class="form-label">Kurir</label>
							<table class="table w-100 table-borderless">
							@foreach ($courier as $cor)
								<tr>
									<td class="d-flex gap-2">
										<input class="form-check-input" type="radio" name="kurir_id" id="kurir_id" data-price="{{ $cor->harga }}" value="{{ $cor->id }}">
										<label class="form-check-label d-flex justify-content-between" for="">
												{{ $cor->nama }}
										</label>
									</td>
									<td class="text-end">
										{{ App\Helpers\GeneralHelper::toRupiah($cor->harga) }}
									</td>
								</tr>
							@endforeach
						</table>
						</div>
						<div class="mb-3">
							<label for="" class="form-label">Metode Pembayaran</label>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="metode_pembayaran" id="metode_pembayaran" value="transfer">
								<label class="form-check-label d-flex justify-content-between" for="">
									Transfer Bank
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="metode_pembayaran" id="metode_pembayaran" value="COD">
								<label class="form-check-label d-flex justify-content-between" for="">
									Cash On Delivery
								</label>
							</div>
						</div>
						<div class="mb-3">
							<label for="" class="form-label">Detail</label>
							<div class="form-check">
								<label class="form-check-label d-flex justify-content-between" for="">
									<p>
										Total Produk
									</p>
									<p>
										<span id="productP"></span>
									</p>
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label d-flex justify-content-between" for="">
									<p>
										Ongkos Kirim
									</p>
									<p>
										<span id="ship"></span>
									</p>
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label d-flex justify-content-between" for="">
									<p>
										Jumlah Tagihan
									</p>
									<p class="text-red-600 font-bold text-2xl">
										<span  id="total"></span>
										<input type="hidden" name="tagihan" id="totalInput">
									</p>
								</label>
							</div>
						</div>
					</div>
				<div class="modal-footer">
					<button type="button" class="p-2 rounded-md bg-slate-600 text-white" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="p-2 rounded-md bg-yellow-400 text-white">Checkout</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script>
	var subtotal = []
	,quantity = []
	,cekP = []
	,cekQ = []
	,plus = []
	,minus = []
	,carts = {!! json_encode($carts->toArray()) !!}
	,total = document.querySelector('#total')
	,productP = document.querySelector('#productP')
	,check = []
	,product_price = 0
	,couriers = document.querySelectorAll('#courier table input')
	,price = 0
	,totalPrice = 0
	
	couriers.forEach(courier => {
		courier.onclick = () => {
			price = parseInt(courier.getAttribute('data-price'))
			document.querySelector('#ship').innerHTML = rupiah(price);
			refreshTotal()
		} 
	});

	function refreshTotal() 
	{
		total.innerHTML = rupiah(product_price + price)
		document.querySelector('#totalInput').value = product_price + price
	}

	for (let i = 1; i <= carts.length ; i++) {
		subtotal[i] = document.querySelector(`#subtotal-${i}`);
		quantity[i] = document.querySelector(`#quantity-${i}`);
		cekQ[i] = document.querySelector(`#cekQ-${i}`);
		plus[i] = document.querySelector(`#plus-${i}`);
		minus[i] = document.querySelector(`#minus-${i}`);
		cekP[i] = document.querySelector(`#cekP-${i}`);
		check[i] = document.querySelector(`#check-${i}`);
	
		subtotal[i].textContent = rupiah(carts[i-1].produk.harga * quantity[i].value);
		cekP[i].textContent = rupiah(carts[i-1].produk.harga * quantity[i].value);
		cekQ[i].value = quantity[i].value;
		if(check[i].checked) {
			result = 0;
			for (let i = 1; i <= carts.length; i++) {
				result += (carts[i-1].produk.harga * quantity[i].value);
			}
			productP.innerHTML = rupiah(result)
			refreshTotal()
		}

		quantity[i].oninput = () => {
			subtotal[i].textContent = rupiah(carts[i-1].produk.harga * quantity[i].value);
			cekP[i].textContent = rupiah(carts[i-1].produk.harga * quantity[i].value);
			cekQ[i].value = quantity[i].value;
			if(check[i].checked) {
				result = 0;
				for (let i = 1; i <= carts.length; i++) {
					result += (carts[i-1].produk.harga * quantity[i].value);
				}
				productP.innerHTML = rupiah(result)
				refreshTotal()
			}
		}
		
		plus[i].onclick = () => {
			quantity[i].value = parseInt(quantity[i].value) + 1
			quantity[i].oninput()
			refreshTotal()
		}

		minus[i].onclick = () => {
			quantity[i].value = parseInt(quantity[i].value) == 1 ? parseInt(quantity[i].value) : parseInt(quantity[i].value) - 1 
			quantity[i].oninput()
			refreshTotal()
		}

		check[i].onclick = () => {
			if(check[i].checked) {
				product_price += (carts[i-1].produk.harga * quantity[i].value)
				productP.innerHTML = rupiah(product_price)
				refreshTotal()
			} else if(!check[i].checked) {
				product_price -= (carts[i-1].produk.harga * quantity[i].value)
				productP.innerHTML = rupiah(product_price)
				refreshTotal()
			}
		}
	}

</script>
@endsection