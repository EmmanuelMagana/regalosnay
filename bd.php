<?php

    include "/conection/conection.php";
      if(!empty($POST))
      {
        $alert = '';
        if(empty($_POST['marca']) || empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['cantidad']) || empty($_POST['precio']) || empty($_POST['tipo']) || empty($_POST['edad']) || empty($_POST['genero']))
        {
          echo '<p> Todos los campos son obligatorios.</p>';
        }else
        {


          $marca  = $_POST['marca'];
          $nombre = $_POST['nombre'];
          $descripcion  = $_POST['descripcion'];
          $cantidad = $_POST['cantidad'];
          $precio = $_POST['precio'];
          $tipo = $_POST['tipo'];
          $edad = $_POST['edad'];
          $genero = $_POST['genero'];

          $query  = mysql_query("SELECT * FROM producto WHERE marca = '$marca' OR nombre = '$nombre'", $conection);
          $result = mysql_fetch_array($query);

          if($result >  0){
            echo '<p>La marca o el nombre ya existe.</p>';
          }else{
            $query_insert = mysql_query("INSERT INTO producto(marca,nombre,descripcion,cantidad,precio,tipo,edad,genero)  VALUES  ($marca,$nombre,$descripcion,$cantidad,$precio,$tipo,$edad,$genero)",$conection);
            if($query_insert){
              echo '<p>Producto registrado correctamente.</p>';
            }else{
              echo '<p>Error al registrar el producto.</p>';
            }
          }
        }
      }

?>
