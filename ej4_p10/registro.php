<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Portada</title>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
</head>

<body>

<div id="contenedor">

	<?php 
		require("cabecera.php"); 
		require("sidebarIzq.php"); 
	?>

	<main>
		<article>
		<h1>Registro de nuevo usuario</h1>
			<form action="index.php" method="POST">
				<fieldset>
					<legend>Datos del usuario</legend>
					<div><label>Correo:</label> <input required type="email" name="email" id="campoEmail" />
						<span id="validEmail">
						<span id="correoOK">&#x2705; </span> <!-- Unicode for ✅ -->
						<span id="correoMal">&#x26A0;</span> <!-- Unicode for ⚠️ -->
						</span>
					</div>
					<div><label>User:</label> <input required type="text" name="username" id="campoUser" />
						<span id="validUser"></span> 
						<span id="userOK">&#x2705; </span> <!-- Unicode for ✅ -->
						<span id="userMal">&#x26A0;</span>  <!-- Unicode for ⚠️ -->
						</span>
					</div>
					<div><label>Password:</label> <input required type="password" name="password" /><br /></div>
					<div><button type="submit">Entrar</button></div>
				</fieldset>
			</form>
		</article>
	</main>

	<?php 
		include("sidebarDer.php"); 
		include("pie.php"); 
	?>

</div> <!-- Fin del contenedor -->

<script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="js/ejercicio4.js"></script>
</body>
</html>