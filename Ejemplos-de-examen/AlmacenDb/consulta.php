<?php
require_once "AccesoProducto.php";
require_once "Producto.php";

$ac = AccesoDatos::initModelo();

$tproductos = $ac-> getProductos();
// Procesar POST si hay datos
// Chequear cookie
// Obtener la lista de productos

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container" style="width: 600px;">
        <div id="header">
            <h1>BAJAR PRECIOS PRODUCTOS SIN PEDIDOS</h1>
        </div>
        <div id="content">
            <form name='entrada' method="post">
                <table>
                    <tr>
                        <th></th>
                        <th>no</th>
                        <th>Descripción</th>
                        <th>stock</th>
                        <th>precio</th>
                    </tr>
                    <!-- INCLUIR EN EL FORMULARIO -->
                     
                    <?php foreach ($tproductos as $pro): ?>
                        <tr>
                            <td><input type="checkbox" name="tproductos[]" value="<?= $pro->producto_no ?>"></td>
                            <td><?= $pro->producto_no ?></td>
                            <td><?= $pro->descripcion  ?></td>
                            <td><?= $pro->stock_disponible ?></td>
                            <td><?= $pro->precio_actual ?></td>
                        <tr>
                        <?php endforeach; ?>

                        <!--
                        // -- PROCESAR EL FORMULARIO
                        // Obtengo una tabla con los números de productos.
                        $tProductoNoActualizar=$_POST["tproductos"];
                        // Actualizo lo productos incluidos en la tabla
                        $bd->actualizarPrecios($tProductoNoActualizar);
                        -->
                
                </table>

                <input type="submit" name="orden" value="ACTUALIZAR">
            </form>
        </div>
    </div>
</body>

</html>