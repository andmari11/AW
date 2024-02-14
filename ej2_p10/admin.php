<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Administración</title>

<style>
    form {
        text-align: center;
    }
    form button {
        margin-top: 10px; /* Ajusta según sea necesario */
    }
</style>

</head>

<body>

<div id="contenedor"> <!-- Inicio del contenedor -->

	<?php
        session_start();
        require("cabecera.php");
        require("sidebarIzq.php");
    ?>

	<main>
        <?php
            if(isset($_SESSION["esAdmin"])){

                echo "<h1>Panel de Administración</h1>";
                echo "Bienvenido.";
            }
            else{

                echo "<h1>Panel de Administración</h1>";
                echo "ACCESO DENEGADO.";

            }
        ?>
	</main>



	<?php
		require("sidebarDer.php");
		require("pie.php");
	?>

</div> <!-- Fin del contenedor -->

</body>
</html>