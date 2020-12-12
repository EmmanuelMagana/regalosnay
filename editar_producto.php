<?php
        include "conection/conection.php";

    if(empty($_GET['id'])){
        header('location: lista_producto.php');
    }else{
        $id =   $_GET['id'];
        if(!is_numeric($id)){
          header('location: lista_producto.php');
        }

        $sql    =   mysqli_query($enlace,"select id,nombre,descripcion,precio,tipo,marca,edad,genero,foto from producto where id=$id");
        $result_sql  =   mysqli_num_rows($sql);

        $fotos = '';
        $remove='notBlock';
        if($result_sql  >  0){
            $data_producto = mysqli_fetch_assoc($sql);

            if($data_producto['foto'] != 'img_producto.png'){
              $remove = '';
              $fotos = '<img id="img"  src="img/uploads/'.$data_producto['foto'].'"alt = "producto">';
            }else{
              $remove = '';
              $fotos = '<img id="img"  src="img/'.$data_producto['foto'].'"alt = "producto">';
            }

        }else{
            header('location: lista_producto.php');
        }

      }
     
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


        $imgProducto  =   'img_producto.jpg';

        $query    =   mysqli_query($enlace,"select * from producto where id  !=   '$id' ");
        $result   =   mysqli_fetch_array($query);
       
        if($result != 0){
          $alert    =    '<p class="msg_error> Ya se encuentra en existencia.</p>'; 
        }else{
            

              if($nombre_foto != ''){
                $imgProducto  = 'img_'.date('D h m s').$nombre_foto;
                $destino = 'img/uploads/'.$imgProducto;
              }elseif($data_producto['foto'] != ''){
                $imgProducto=$data_producto['foto'];
              }
              
              $sql_update =   mysqli_query($enlace,"update producto set nombre = '$nombre',descripcion = '$descripcion', precio = '$precio',tipo = '$tipo',marca = '$marca',edad = '$edad',genero = '$genero',foto = '$imgProducto' where id='$id'");
              
                  if($sql_update){ 
                      if($nombre_foto != ''){ 
                          move_uploaded_file($url_temp,$destino);
                          unlink('img/uploads/'.$data_producto['foto']);
                      }
                      $alert  =    '<p class="msg_save">Producto actualizado correctamente.</p>';
                  }else{
                      $alert  =    '<p class="msg_error">Error al actualizado el producto.</p>';
                  } 
                  header('location: lista_producto.php');
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
            <form action="" method="post" enctype="multipart/form-data" class="card-body">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $data_producto['nombre']; ?>">
                </div>
                <div>
                <label for="descripcion">Descripcion</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo $data_producto['descripcion']; ?>">
                </div>
                <div>
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" step="any" value="<?php echo $data_producto['precio']; ?>">
                </div>
                <div>
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo" value="<?php echo $data_producto['tipo']; ?>" required>
                    <option>z</option>
                    <option>s</option>
                    </select>
                    <div class="invalid-feedback">
                        Seleccione un tipo.
                    </div>
                </div>

                <div>
                    <label for="marca">Marca</label>
                    <select id="marca" name="marca" value="<?php echo $data_producto['marca']; ?>" required>
                    <option>ppp</option>
                    <option></option>
                    </select>
                    <div class="invalid-feedback">
                        Seleccione un marca.
                    </div>
                </div>

                <div>
                    <label for="edad">Edad recomendada</label>
                    <select id="edad" name="edad" value="<?php echo $data_producto['edad']; ?>" required>
                    <option>0-3</option>
                    <option>3-5</option>
                    </select>
                    <div class="invalid-feedback">genero
                        Seleccione un edad.
                    </div>
                </div>

                <div>
                    <label for="genero">Genero</label>
                    <select id="genero" name="genero" value="<?php echo $data_producto['genero']; ?>" required>
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
                        <span class="delPhoto <?php  echo $remove; ?>">X</span>
                        <label for="foto" ></label>
                        <?php echo $fotos;  ?>
                      </div>
                      <div class="upimg">
                        <input type="file" name="foto" id="foto" >
                      </div>
                      <div id="form_alert"></div>
              </div>
                <hr>
                <center>
              <div>
              <a href="lista_producto.php" class="btn btn-outline-info btn-sm">Cancelar</a>
              
              <input type="submit" value="Actualizar" class="btn btn-outline-success btn-sm">
              </div>
              </center>

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