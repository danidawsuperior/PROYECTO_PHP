<?php
session_start();

if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 100;
}
$anulada = false;
$msg = "Valor del contador = " . $_SESSION['contador'];

if (isset($_POST['orden'])) {
$valor = $_POST['orden'];

    switch ($valor) {
        case 'Incrementar':
            $_SESSION['contador']++;
            $msg = "Valor del contador = " .$_SESSION['contador'];
            break;
        case 'Decrementar':
            $_SESSION['contador']--;
            $msg = "Valor del contador = " .$_SESSION['contador'];
            break;
        case 'Anular':
            session_unset();
            session_destroy();
            $msg = "La sesion ha sido anulada ";
            $anulada = true;
            break;
    }

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
    
    <form method="post">
        <?php if($anulada){ ?>
            <p> <?= $msg ?> </p>
            <a href="contadorsesion.php"><input type="button" value="Recargar" onclick="location.reload();"></a>

        <?php } else {  ?>
        <p> <?= $msg ?> </p>
        <button type="submit" name="orden" value="Incrementar"> Incrementar </button>
        <button type="submit" name="orden" value="Decrementar"> Decrementar </button>
        <button type="submit" name="orden" value="Anular">Anular</button>
        
        <?php }?>


    </form>

</body>

</html>
