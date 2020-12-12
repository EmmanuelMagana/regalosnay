<?php
    include "conection/conection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <title>Lista Producto</title>
</head>
<body>
    <section class="container-fluid">

    <?php 
    
    $busqueda = strtolower($_REQUEST['busqueda']);
    if(empty($busqueda)){
        header("location: lista_producto.php");
    }
    ?>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <h1 class="text-white mr-4" >Listas productos</h1>
        <a href="checkout-page.php" class="btn btn-outline-info btn-sm">Crear producto</a>
        <form class="form-inline ml-auto" action="buscar_producto.php" method="get">
            <input class="form-control mr-sm-2" type="text" placeholder="Buscar" name="busqueda" id="busqueda" value="<?php echo $busqueda; ?>">
            <input type="submit" class="btn btn-success btn-sm" value="Buscar">
        </form>
    </nav>
       <br>
    </div>
        <table class="table table-sm table-dark table-striped ">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Img</th>
                <th>Accion</th>
            </tr>
            <?php
                //paginador

                $sql_regite = mysqli_query($enlace,"SELECT COUNT(*) as total from producto where (id like '%$busqueda%' or nombre like '%$busqueda%' or descripcion like '%$busqueda%' or existencia like '%$busqueda%' or precio like '%$busqueda%')");

                $result_register = mysqli_fetch_array($sql_regite);
                $total_registro = $result_register["total"];
                $por_pagina = 2;
                if(empty($_GET['pag'])){
                    $pag = 1;
                }else{
                    $pag = $_GET['pag'];
                }
                $desde = ($pag -1) * $por_pagina;
                $total_pag = ceil($total_registro / $por_pagina);

                $query = mysqli_query($enlace,"SELECT id,nombre,descripcion,existencia,precio,foto from producto where (id like '%$busqueda%' or nombre like '%$busqueda%' or descripcion like '%$busqueda%' or existencia like '%$busqueda%' or precio like '%$busqueda%') order by id asc limit $desde,$por_pagina");

                $result =  mysqli_num_rows($query);

                if($result > 0){
                    while($data    =    mysqli_fetch_array($query)){
                        if($data['foto'] == 'img_producto.png' || $data['foto'] == ''){
                            $foto = 'img/img_producto.png';
                        }else{
                            $foto = 'img/uploads/'.$data['foto'];
                        }

            ?>
                        <tr>
                            <td><?php echo $data["id"] ?></td>
                            <td><?php echo $data["nombre"] ?></td>
                            <td><?php echo $data["descripcion"] ?></td>
                            <td><?php echo $data["existencia"] ?></td>
                            <td><?php echo $data["precio"] ?></td>
                            <td><img width="60px" src="<?php echo $foto; ?>" alt="<?php echo $data['foto']; ?>"></td>
                            <td>
                                <a class="text-success" href="editar_producto.php?id=<?php echo $data["id"] ?>">Editar</a>
                                |
                                <a class="text-danger" href="delete_producto.php?id=<?php echo $data["id"] ?>">Eliminar</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            ?>
        </table>
        <?php 
        
        if($total_registro != 0)
            {
        ?>
        <hr>
        <nav aria-label="...">
            <ul class="pagination justify-content-center">
            <?php 
                if($pag != 1){
            ?>
                <li class="page-item">
                <a class="page-link" href="?pag=<?php echo $pag -1; ?>&busqueda=<?php echo $busqueda; ?>" >Previous</a>
                </li>
                <?php
                }
                    for($i=1;$i<=$total_pag;$i++){
                        if($i == $pag){
                            echo '<li class="page-item active"><a class="page-link" '.$i.'">'.$i.'</a></li>';
                        }else{
                            echo '<li class="page-item"><a class="page-link" href="?pag='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
                        }
                    }

                    if($pag != $total_pag){
                ?>
                <li class="page-item">
                <a class="page-link" href="?pag=<?php echo $pag +1; ?>&busqueda=<?php echo $busqueda; ?>">Next</a>
                </li>
                    <?php  } ?>
            </ul>
        </nav>
        <?php 
            }
        ?>
    </section>
    
</body>
</html>