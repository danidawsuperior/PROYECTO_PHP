<?php
require_once "AccesoProducto.php";
require_once "Producto.php";

$ac = AccesoDatos::initModelo();

$mensajeError = "";

// Procesar POST si hay datos
// Chequear cookie

$msg = "";
//['consultarCambios'] no tieneque estar declarado en ningun lado entonces devuelve false;
if (isset($_POST['orden'])) {
    if (isset($_COOKIE['consultarCambios'])) {
        $msg = "Lo sentimos, solo se puede realizar una actualización por dia";
    } elseif (empty($_POST['tproductos'])) {
        $mensajeError = " ERROR: Debes seleccionar los precios que quieres realizar la rebaja del 10%";
    } else {
        // Obtener la lista de productos
        // -- PROCESAR EL FORMULARIO
        setcookie("consultarCambios", date("d/m/Y"), time() + 3600 * 24);
        $tProductoActualizar = $_POST['tproductos'];
        // Actualizo los productos incluidos en la tabla
        $ac->actualizarPrecios($tProductoActualizar);
        $msg = "Productos actualizados correctamente";
    }
}

$tproductos = $ac->getProductos();

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
            <?= $msg ?>
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
                        </tr>
                    <?php endforeach; ?>

                </table>
                <?= $mensajeError ?>

                <input type="submit" name="orden" value="ACTUALIZAR">
            </form>
        </div>
    </div>
</body>

</html>