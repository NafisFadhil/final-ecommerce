import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
// var subtotal = []
// 	,quantity = []
// 	,cekP = []
// 	,cekQ = []
// 	,plus = []
// 	,minus = []
// 	,carts = {!! json_encode($carts->toArray()) !!}
// 	,total = document.querySelector('#total')
// 	,productP = document.querySelector('#productP')
// 	,check = []
// 	,product_price = 0
// 	,couriers = document.querySelectorAll('#courier table input')
// 	,price = 0
// 	,totalPrice = 0
	
// 	couriers.forEach(courier => {
// 		courier.onclick = () => {
// 			price = parseInt(courier.getAttribute('data-price'))
// 			document.querySelector('#ship').innerHTML = rupiah(price);
// 			refreshTotal()
// 		} 
// 	});

// 	function refreshTotal() 
// 	{
// 		total.innerHTML = rupiah(product_price + price)
// 		document.querySelector('#totalInput').value = product_price + price
// 	}

// 	for (let i = 1; i <= carts.length ; i++) {
// 		subtotal[i] = document.querySelector(`#subtotal-${i}`);
// 		quantity[i] = document.querySelector(`#quantity-${i}`);
// 		cekQ[i] = document.querySelector(`#cekQ-${i}`);
// 		plus[i] = document.querySelector(`#plus-${i}`);
// 		minus[i] = document.querySelector(`#minus-${i}`);
// 		cekP[i] = document.querySelector(`#cekP-${i}`);
// 		check[i] = document.querySelector(`#check-${i}`);
	
// 		subtotal[i].textContent = rupiah(carts[i-1].produk.harga * quantity[i].value);
// 		cekP[i].textContent = rupiah(carts[i-1].produk.harga * quantity[i].value);
// 		cekQ[i].value = quantity[i].value;
// 		if(check[i].checked) {
// 			result = 0;
// 			for (let i = 1; i <= carts.length; i++) {
// 				result += (carts[i-1].produk.harga * quantity[i].value);
// 			}
// 			productP.innerHTML = rupiah(result)
// 			refreshTotal()
// 		}

// 		quantity[i].oninput = () => {
// 			subtotal[i].textContent = rupiah(carts[i-1].produk.harga * quantity[i].value);
// 			cekP[i].textContent = rupiah(carts[i-1].produk.harga * quantity[i].value);
// 			cekQ[i].value = quantity[i].value;
// 			if(check[i].checked) {
// 				result = 0;
// 				for (let i = 1; i <= carts.length; i++) {
// 					result += (carts[i-1].produk.harga * quantity[i].value);
// 				}
// 				productP.innerHTML = rupiah(result)
// 				refreshTotal()
// 			}
// 		}
		
// 		plus[i].onclick = () => {
// 			quantity[i].value = parseInt(quantity[i].value) + 1
// 			quantity[i].oninput()
// 			refreshTotal()
// 		}

// 		minus[i].onclick = () => {
// 			quantity[i].value = parseInt(quantity[i].value) == 1 ? parseInt(quantity[i].value) : parseInt(quantity[i].value) - 1 
// 			quantity[i].oninput()
// 			refreshTotal()
// 		}

// 		check[i].onclick = () => {
// 			if(check[i].checked) {
// 				product_price += (carts[i-1].produk.harga * quantity[i].value)
// 				productP.innerHTML = rupiah(product_price)
// 				refreshTotal()
// 			} else if(!check[i].checked) {
// 				product_price -= (carts[i-1].produk.harga * quantity[i].value)
// 				productP.innerHTML = rupiah(product_price)
// 				refreshTotal()
// 			}
// 		}
// 	}
