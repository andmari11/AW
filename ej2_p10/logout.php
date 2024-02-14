<?php
    session_start();
    unset($_SESSION["nombre"]);
    unset($_SESSION["login"]);
    if(isset($_SESSION["esAdmin"])){
        unset($_SESSION["esAdmin"]);
    }
    session_destroy();
?>



<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Login</title>
</head>

<body>

<div id="contenedor"> <!-- Inicio del contenedor -->

	<?php
        require("cabecera.php");
        require("sidebarIzq.php");
    ?>

	<main>
    <article>
		<h1>Sesión cerrada</h1>
		<p>Gracias por visitar nuestra web. ¡Hasta pronto!</p>
	  </article>
	</main>



	<?php
		require("sidebarDer.php");
		require("pie.php");
	?>

</div> <!-- Fin del contenedor -->

</body>
</html>

