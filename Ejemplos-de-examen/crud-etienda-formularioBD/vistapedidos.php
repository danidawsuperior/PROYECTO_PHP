<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Pedidos</title>

    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid;
            padding: 10px 10px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <header>
            <h1>Pedidos de <span class="city-badge"><?= $nombre_cliente ?> </span> con código de cliente: <?= $codigo_cliente ?></h1>
        </header>

        <table>
            <thead>
                <tr>
                    <th>Código de cliente</th>
                    <th>Producto</th>
                    <th>Numero de pedido</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php $sumaTotal = 0; ?>
                <!-- Tabla a genera en PHP -->

                <?php foreach ($listaPedidos as $pedidos): ?>
                    <?php $sumaTotal += $pedidos->precio ?>

                    <tr>
                        <td><?= $pedidos->cod_cliente; ?> </td>
                        <td class="price"><strong><?= $pedidos->producto; ?></strong></td>
                        <td><?= $pedidos->numped;  ?></td>
                        <td><?= $pedidos->precio; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><strong> Total </strong></td>
                    <td></td>
                    <td></td>
                    <td><strong><?= $sumaTotal ?></strong></td>
                </tr>

            </tbody>
        </table>

        <a href="acceso.html" class="back-link">← Volver al inicio</a>
    </div>
</body>

</html>