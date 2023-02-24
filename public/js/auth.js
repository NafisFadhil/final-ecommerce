var pw = document.querySelector('#password');

document.querySelector('#showPw').onchange = () => {
	if(pw.type == 'password') {
		pw.type = 'text'
	} else {
		pw.type = 'password'
	}
}