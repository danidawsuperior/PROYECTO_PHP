<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Pedidos</title>
</head>
<body>
    
<div class="container">
    <header>
        <h1>Pedidos de <span class="city-badge"><?= $nombre_cliente ?> </span></h1>
    </header>
     
    <table>
        <thead>
           <tr>
                <th>Numero de pedido</th>
                <th>Código de cliente</th>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <!-- Tabla a genera en PHP -->
       
        <?php foreach ( $listapedidos as $pedidos):?>
          <tr>
                <td><strong><?= $pedidos->numped;  ?></strong></td>
                <td><?= verClase($pedidos->cod_cliente); ?> </td>
                <td class="price"><?= $pedidos->producto; ?></td>
                <td><?= verEstado($pedidos->precio); ?></td>
                              
         </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="acceso.html" class="back-link">← Volver al inicio</a>
</div>
</body>
</html>