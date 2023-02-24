const navbar = document.querySelector('.nav-menu');

document.querySelector('#toggle').onclick = () => {
	navbar.classList.toggle('active');
}

if(document.querySelector('.alert')) {
	setTimeout(() => {
		document.querySelector('.alert').remove()
	}, 3000);
}

const rupiah = (number) => {
	return new Intl.NumberFormat("id-ID", {
		style: "currency",
		currency: "IDR",
		minimumFractionDigits: 0
	}).format(number);
}