$(document).ready(function() {

	$("#correoOK").hide();
	$("#userOK").hide();
	$("#correoMal").hide();
	$("#userMal").hide();


	$("#campoEmail").change(function(){
		const campo = $("#campoEmail"); // referencia jquery al campo
		campo[0].setCustomValidity(""); // limpia validaciones previas

		// validación html5, porque el campo es <input type="email" ...>
		const esCorreoValido = campo[0].checkValidity();
		if (esCorreoValido && correoValidoUCM(campo.val())) {
			// el correo es válido y acaba por @ucm.es: marcamos y limpiamos quejas
		
			// tu código aquí: coloca la marca correcta

			campo[0].setCustomValidity("");
			$("#correoOK").show();
			$("#correoMal").hide();
		} else {			

			// tu código aquí: coloca la marca correcta

			campo[0].setCustomValidity(
				"El correo debe ser válido y acabar por @ucm.es");
				$("#correoOK").hide();
				$("#correoMal").show();
		}
	});

	
	$("#campoUser").change(function(){
		var url = "comprobarUsuario.php?user=" + $("#campoUser").val();
		$.get(url,usuarioExiste);
  });


	function correoValidoUCM(correo) {
		// Comprueba si el correo termina en @ucm.es
		return correo.endsWith("@ucm.es");
	}

	function usuarioExiste(data,status) {
		// tu codigo aqui
		if (data === "existe") {
			$("#userOK").hide();
			$("#userMal").show();
			alert("El nombre de usuario ya está en uso");

		} else {
			$("#userOK").show();
			$("#userMal").hide();
		}
	}
})
