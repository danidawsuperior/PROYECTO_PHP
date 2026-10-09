<?php
if ($_SERVER['REMOTE_ADDR'] != "127.0.0.1"){
    echo "Acceso no permitido";
    exit;
}
foreach( $_SERVER as $clave => $valor){
    echo $clave . "--->" .$valor, "<br>";
}
?>