<?php
    session_start();
    $username= htmlspecialchars(trim(strip_tags($_REQUEST["usuario"])));
    $password= htmlspecialchars(trim(strip_tags($_REQUEST["contraseña"])));

    if($username == "user" && $password == "userpass"){

        $_SESSION["login"]=true;
        $_SESSION["nombre"]="Usuario";
    }
    else if ($username == "admin" && $password == "adminpass"){
        
        $_SESSION["login"]=true;
        $_SESSION["nombre"]="Administrador";
        $_SESSION["esAdmin"]=true;
    }
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
        <?php
            if(isset($_SESSION["login"])){

                echo "<h1>Bienvenido {$_SESSION['nombre']} </h1>";
                echo "Descubre contenido exclusivo " . "<a href='contenido.php'>aquí.</a>";
            }
            else{

                echo "<h1>ERROR</h1>";
                echo "Usuario y/o contraseña invalidos, " . "<a href='login.php'>inténtelo de nuevo</a>" . ".";
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

