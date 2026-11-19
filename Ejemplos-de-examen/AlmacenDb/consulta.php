<?php
require_once "AccesoProducto.php";
require_once "Producto.php";

$ac = AccesoDatos::initModelo();

$tproductos = $ac->getProductos();
$mensajeError = "";

// Procesar POST si hay datos
// Chequear cookie
function revisarActualizaciones():string{
    $msg = "";
    $nactualizaciones = 0;
    //['consultas'] no tieneque estar declarado en ningun lado entonces devuelve false;
    if(isset($_COOKIE['consultas'])){
        $nactualizaciones = $_COOKIE['consultas'];
    }
    if($nactualizaciones > 1){
        $msg = "Lo sentimos, solo se puede realizar una actualización por dia";
    }
    return $msg;
}
// Obtener la lista de productos
// -- PROCESAR EL FORMULARIO
if (!empty($_POST['tproductos'])) {
    $mensajeError = "";
    // Obtengo una tabla con los números de productos.
    $tProductoActualizar = $_POST["tproductos"];
    // Actualizo los productos incluidos en la tabla
    $ac->actualizarPrecios($tProductoActualizar);
    $tproductos = $ac->getProductos();
} else {
    $mensajeError = " ERROR: Debes seleccionar los precios que quieres realizar la rebaja del 10%";
}


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
            <?= revisarActualizaciones() ?>
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

                </table>
                <?= $mensajeError ?>

                <input type="submit" name="orden" value="ACTUALIZAR">
            </form>
        </div>
    </div>
</body>

</html>