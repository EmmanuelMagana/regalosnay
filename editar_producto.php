<?php
        include "conection/conection.php";
      
      if(!empty($_POST))
      {
        $alert = '';
        if(empty($_POST['marca']) || empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['tipo']) || empty($_POST['edad']) || empty($_POST['genero']))
        {
          $alert    =    '<p class="msg_error> Todos los campos son obligatorios.</p>';
        }else
        {
            
          $id   =   $_POST['id'];
          $marca  = $_POST['marca'];
          $nombre = $_POST['nombre'];
          $descripcion  = $_POST['descripcion'];
          $precio = $_POST['precio'];
          $tipo = $_POST['tipo'];
          $edad = $_POST['edad'];
          $genero = $_POST['genero'];

          $foto =   $_FILES['foto'];
          $nombre_foto  =   $_FILES['foto']['name'];
          $type         =   $_FILES['foto']['type'];
          $url_temp     =   $_FILES['foto']['tmp_name'];

          $imgProducto  =   'img_producto';

          $query    =   mysqli_query($enlace,"select * from producto where (id  !=   '$id' and nombre =   '$nombre'");
          $result   =   mysqli_fetch_array($query);

          if($result > 0){
            $alert    =    '<p class="msg_error> Ya se encuentra en existencia.</p>';
          }else{
              
                $sql_update =   mysqli_query($enlace,"update producto set nombre = '$nombre',descripcion = '$descripcion', precio = '$precio',tipo = '$tipo',marca = '$marca',edad = '$edad',genero = '$genero',foto = '$foto'");

                if($nombre_foto != ''){
                    $imgProducto  = 'img/uploads/'.'img_'.date('d m Y').'.jpg';
                }

                    $query_insert = mysqli_query($enlace,"INSERT INTO producto(marca,nombre,descripcion,existencia,precio,tipo,edad,genero,foto)  VALUES('$marca','$nombre','$descripcion','$cantidad','$precio','$tipo','$edad','$genero','$imgProducto')");

                    if($query_insert){
                        if($nombre_foto != ''){
                            move_uploaded_file($url_temp,$imgProducto);
                        }
                        $alert  =    '<p class="msg_save">Producto actualizado correctamente.</p>';
                    }else{
                        $alert  =    '<p class="msg_error">Error al actualizado el producto.</p>';
                    }
            }
          }
        }

    if(empty($_GET['id'])){
        header('location: lista_producto.php');
    }
    $id =   $_GET['id'];

    $sql    =   mysqli_query($enlace,"select id,nombre,descripcion,precio,tipo,marca,edad,genero,foto from producto where id=$id");
    $result_sql  =   mysqli_num_rows($sql);

    if($result_sql  ==  0){
        header('location: lista_producto.php');
    }else{
        while($data =   mysqli_fetch_array($sql)){
            $id =   $data['id'];
            $nombre =   $data['nombre'];
            $descripcion =   $data['descripcion'];
            $precio =   $data['precio'];
            $tipo =   $data['tipo'];
            $marca =   $data['marca'];
            $edad =   $data['edad'];
            $genero =   $data['genero'];
            if($data['foto'] == 'img_producto.png' || $data['foto'] == ''){
              $foto = 'img/img_producto.png';
            }else{
              $foto = 'img/uploads/'.$data['foto'];
            }
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/checkout-page.css" type="text/css">
    <link rel="stylesheet" href="css/edit.css" type="text/css">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
</head>
<body>
    <section id="container">
        <div class="form_register">
            <h1>Editar Producto</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">

                <label for="descripcion">Descripcion</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>">
                
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" step="any" value="<?php echo $precio; ?>">

                <div>
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo" value="<?php echo $tipo; ?>" required>
                    <option>z</option>
                    <option>s</option>
                    </select>
                    <div class="invalid-feedback">
                        Seleccione un tipo.
                    </div>
                </div>

                <div>
                    <label for="marca">Marca</label>
                    <select id="marca" name="marca" value="<?php echo $marca; ?>" required>
                    <option>z</option>
                    <option>s</option>
                    </select>
                    <div class="invalid-feedback">
                        Seleccione un marca.
                    </div>
                </div>

                <div>
                    <label for="edad">Edad recomendada</label>
                    <select id="edad" name="edad" value="<?php echo $edad; ?>" required>
                    <option>0-3</option>
                    <option>3-5</option>
                    </select>
                    <div class="invalid-feedback">genero
                        Seleccione un edad.
                    </div>
                </div>

                <div>
                    <label for="genero">Genero</label>
                    <select id="genero" name="genero" value="<?php echo $genero; ?>" required>
                    <option>Niño</option>
                    <option>Niña</option>
                    </select>
                    <div class="invalid-feedback">
                        Seleccione un genero.
                    </div>
                </div>

                <hr>

              <div class="photo">
                <center>
                  <label for="foto">Foto</label>
                </center>
                      <div class="prevPhoto">
                        <span class="delPhoto notBlock">X</span>
                        <label for="foto"></label>
                      </div>
                      <div class="upimg">
                        <input type="file" name="foto" id="foto" value="<?php echo $foto; ?>">
                      </div>
                      <div id="form_alert"></div>
              </div>
                <hr>
              <input class="btn_save" type="submit" value="Actualizar">

            </form>
        </div>
    </section>

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>
  <script defer src="js/function.js" ></script>
</body>
</html>