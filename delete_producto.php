<?php

    include "conection/conection.php";

    if(!empty($_POST)){

        $id = $_POST['id'];
        $query_delete = mysqli_query($enlace,"delete from producto where id = $id");

        if($query_delete){
            header('location: lista_producto.php');
        }else{
            echo 'Error al eliminar';
        }
    }

    if(empty($_REQUEST['id'])){
        header('location: lista_producto.php');
    }else{

        $id = $_REQUEST['id'];

        $sql    =   mysqli_query($enlace,"select nombre,descripcion,marca,foto from producto where id=$id");
        $result_sql  =   mysqli_num_rows($sql);

        if($result_sql > 0){
            while($data =   mysqli_fetch_array($sql)){

                $nombre =   $data['nombre'];
                $descripcion =   $data['descripcion'];
                $marca =   $data['marca'];
                if($data['foto'] == 'img_producto.png' || $data['foto'] == ''){
                    $foto = 'img/img_producto.png';
                }else{
                    $foto = 'img/uploads/'.$data['foto'];
                }
                
            }
        }else{
            header('location: lista_producto.php');

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
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
</head>
<body>
    <section id=container>
        <div class="text-center">
            <h2>¿Estas seguro de eliminar el siguiente producto?</h2>
            <p>Nombre : <span class="text-primary "><?php echo $nombre; ?></span></p>
            <p>Descripcion : <span><?php echo $descripcion; ?></span></p>
            <p>Marca : <span><?php echo $marca; ?></span></p>
            <p>Foto : <span><img width="300px" src="<?php echo $foto; ?>" alt="<?php echo $data['nombre']; ?>"></span></p>
            <form method="post" action="">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <a href="lista_producto.php" class="btn_can">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
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