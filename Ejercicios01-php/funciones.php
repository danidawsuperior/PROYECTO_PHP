<?php
function sumar (int $valor1, int $valor2): int{
    $resu =  $valor1 + $valor2;
    $valor1 = 100;
    return $resu;
}

function sumar2 (int $valor1, int $valor2, int & $resu){
    // Si yo quiero que un valor se modifique hay que poner &.
    $resu =  $valor1 + $valor2;
}
?>