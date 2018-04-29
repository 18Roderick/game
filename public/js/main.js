function validateFrom() {

	return true;

}

function buscarUsuario(user) {

	console.log(user.value.length);
	const data = {
		user:user.value
	}
	if (user.value.length > 0) {
		$.ajax({
			data,
			url: 'http://localhost/game/data_info.php',
			type: 'GET',
			beforeSend: () => {
				$("#usuario").html("Procesando, espere por favor...");
			},
			success: response => {
				$("#usuario").html(response);
			}
		})



	} else {

		document.getElementById('usuario').innerHTML = '';
		return;

	}

}

