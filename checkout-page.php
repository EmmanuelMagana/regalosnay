<?php
        include "conection/conection.php";
  
      if(!empty($_POST))
      {
        $alert = '';
        if(empty($_POST['marca']) || empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['cantidad']) || empty($_POST['precio']) || empty($_POST['tipo']) || empty($_POST['edad']) || empty($_POST['genero']))
        {
          $alert    =    '<p class="msg_error> Todos los campos son obligatorios.</p>';
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

          $foto =   $_FILES['foto'];
          $nombre_foto  =   $_FILES['foto']['name'];
          $type         =   $_FILES['foto']['type'];
          $url_temp     =   $_FILES['foto']['tmp_name'];

          $imgProducto  =   'img_producto.png';

          if($nombre_foto != ''){
            $imgProducto  = 'img_'.date('D h m s').$nombre_foto;
            $destino = 'img/uploads/'.$imgProducto;
          }

            $query_insert = mysqli_query($enlace,"INSERT INTO producto(marca,nombre,descripcion,existencia,precio,tipo,edad,genero,foto)  VALUES('$marca','$nombre','$descripcion','$cantidad','$precio','$tipo','$edad','$genero','$imgProducto')");

            if($query_insert){
                if($nombre_foto != ''){
                    move_uploaded_file($url_temp,$destino);
                }
                $alert  =    '<p class="msg_save">Producto registrado correctamente.</p>';
            }else{
                $alert  =    '<p class="msg_error">Error al registrar el producto.</p>';
            }
          }
        }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Registro Producto</title>
  <link rel="stylesheet" href="css/checkout-page.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
</head>

<body>

  <!-- Navbar -->
   <!-- Navbar -->

  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">REGISTRO DE PRODUCTO</h2>

        <!--Grid column-->
        <div class="col-md-7 mb-4">
          <!--Card-->
          <div class="card">
            <!--Card content-->
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <form action="" class="card-body" method="POST" enctype="multipart/form-data">

                  <!--nombre-->
                  <div class="md-form">
                    <input type="text" id="nombre" name="nombre" class="style_reg">
                    <label for="nombre" >Nombre</label>
                  </div>

              <!--descripcion-->
              <div class="md-form">
                <input type="text" id="descripcion" name="descripcion" class="form-control">
                <label for="descripcion">Descripción</label>
              </div>

              <!--cantidad-->
              <div class="md-form">
                <input type="number" id="cantidad" name="cantidad" class="style_reg">
                <label for="cantidad">Cantidad</label>
              </div>

              <!--precio-->
              <div class="md-form">
                <input type="number" id="precio" name="precio" class="style_reg" step="any">
                <label for="precio">Precio</label>
              </div>

              <!--Grid row-->
              <div class="row">

              <!--tipo-->
              <div class="col-lg-4 col-md-6 mb-4">

                <label for="tipo">Tipo: </label>
                <select class="custom-select d-block w-100" id="tipo" name="tipo" required>
                  <option value="">Elige una opción...</option>
                  <option>z</option>
                  <option>s</option>
                </select>
                <div class="invalid-feedback">
                  Seleccione un tipo.
                </div>

              </div>

              <!--Grid column-->
              <div class="col-lg-4 col-md-12 mb-4">

                <label for="marca">Marca: </label>
                <select class="custom-select d-block w-100" id="marca" name="marca" required>
                  <option value="">Elige una opción...</option>
                  <option>ppp</option>
                </select>
                <div class="invalid-feedback">
                  Seleccione una marca.
                </div>

              </div>
              <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4">

                  <label for="edad">Edad recomendada: </label>
                  <select class="custom-select d-block w-100" id="edad" name="edad" required>
                    <option value="">Elige una opción...</option>
                    <option>0-3</option>
                  </select>
                  <div class="invalid-feedback">
                    Seleccione una edad.
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4">

                  <label for="genero">Genero: </label>
                  <select class="custom-select d-block w-100" id="genero" name="genero" required>
                    <option value="">Elige una opción...</option>
                    <option>Niño</option>
                    <option>Niña</option>
                  </select>
                  <div class="invalid-feedback">
                    Seleccione un genero.
                  </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

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
                        <input type="file" name="foto" id="foto" >
                      </div>
                      <div id="form_alert"></div>
              </div>
              

              <hr class="mb-4">
              <center>
              <div>
              <a href="lista_producto.php" class="btn btn-outline-info btn-sm">Ver Lista</a>
              
              <input type="submit" value="Aceptar" class="btn btn-outline-success btn-sm">
              </div>
              </center>
            </form>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

    </div>
  </main>
  <!--Main layout-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
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
