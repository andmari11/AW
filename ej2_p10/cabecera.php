<header>
		<h1>Mi gran página web</h1>
		<div class="saludo">
        <?php
        saludar();
        ?>
</header>


<?php

    function saludar(){

        if(isset($_SESSION["login"])){

            echo "Bienvenido " . $_SESSION["nombre"] . " <a href='logout.php'> Logout</a>";
        }
        else{

            echo "Usuario desconocido " . "<a href='login.php'>Login</a>";

        }
    }
?>
