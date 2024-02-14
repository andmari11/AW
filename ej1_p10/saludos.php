<?php
    $vueltas = $_GET['num'];
    echo '<h1>Me han pedido que te salude ' . $vueltas . ' veces.</h1>';
    if ($vueltas == 42){
        echo '<p>En realidad, esa es la respuesta a la pregunta final sobre la vida, el universo y todo lo demás.</p>';
    }
    else {
        for ($i = 0; $i < $vueltas; $i++){
            echo '<p>' . $i . ' - ¡Hola Mundo!</p>';
        }
    }
?>  