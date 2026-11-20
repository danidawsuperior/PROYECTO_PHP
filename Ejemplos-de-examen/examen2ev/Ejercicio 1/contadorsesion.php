<?php
$contador = 0;
function incrementar():int{
    for ($i = 0; $i < 10; $i++) {
        $contador += $i;
    }
    return $contador;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>CONTADOR CON SESIÓN</h1>
    <p>Valor del contador = <?= $contador ?> </p>
    <form method="post">
        <button type="submit" name="incrementar" > Incrementar </button>
        <input type="button" value=" Recargar " onclick="location.reload();">

    </form>


</body>

</html>