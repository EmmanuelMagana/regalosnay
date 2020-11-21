<?php
    include "conection/conection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/checkout-page.css">
    <title>Lista Producto</title>
</head>
<body>
    <section>
        <table>
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

                $query  =   mysqli_query($enlace,"select id,nombre,descripcion,existencia,precio,foto from producto");

                $result =   mysqli_num_rows($query);

                if($result > 0){
                    while($data    =    mysqli_fetch_array($query)){
                        if($data['foto'] == 'img_producto.png' || $data['foto'] == ''){
                            $foto = 'img/img_producto.png';
                        }else{
                            $foto = $data['foto'];
                        }

            ?>
                        <tr>
                            <td><?php echo $data["id"] ?></td>
                            <td><?php echo $data["nombre"] ?></td>
                            <td><?php echo $data["descripcion"] ?></td>
                            <td><?php echo $data["existencia"] ?></td>
                            <td><?php echo $data["precio"] ?></td>
                            <td class="img_producto"><img src="<?php echo $foto; ?>" alt="<?php echo $data['nombre']; ?>"></td>
                            <td>
                                <a class="link_edit" href="editar_producto.php?id=<?php echo $data["id"] ?>">Editar</a>
                                |
                                <a class="link_delete" href="delete_producto.php?id=<?php echo $data["id"] ?>">Eliminar</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            ?>
        </table>
    </section>
</body>
</html>