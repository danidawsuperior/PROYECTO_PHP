<?php
header("Refresh:3; url=acceso.html");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Error</title>
</head>

<body>
    <div class="container">

        <div class="icon-prohibido">🚫 </div>

        <p> <?= $mensajeError; ?></p>
        
        <div class="volver-a-acceso">
            <a href="acceso.html" >REINTENTAR</a>
        </div>


    </div>
</body>

</html>