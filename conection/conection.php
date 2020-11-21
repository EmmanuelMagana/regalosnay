<?php

    $host       = 'localhost';
    $user       = 'root';
    $password   ='jonny231192';
    $db         ='regalos';

    $enlace  =   @mysqli_connect($host,$user,$password,$db);

    if(!$enlace){
        echo '<h1>Error en la conexion</h1>';
    }

?>