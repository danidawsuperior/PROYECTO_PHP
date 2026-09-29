<?php

function suma(int $num1, int $num2): int
{
    $resu = $num1 + $num2;
    return $resu;
}

function resta(int $num1, int $num2): int
{
    $resu = $num1 - $num2;
    return $resu;
}

function operar(int $num1, int $num2, callable $metodo): int
{
    $resu = $metodo($num1, $num2);

    return $resu;
}




function sumapos(array $t): int
{
    $resu = 0;
    // Si solo ponemos este for si no estan rdenadas las claves numericas daría error, es mejor hacer un foreach
    /*
    for($i=0; $i < count($t); $i++){
        if($t[$i] > 0){
            $resu += $t[$i];
        }
    }
    */
    foreach ($t as $valor) {
        if ($valor > 0) {
            $resu += $valor;
        }
    }
    return $resu;
}

// El & lo que hace es que coge el array real no una copia
function sumaposceros(array &$t): int
{
    $resu = 0;
    foreach ($t as $key => $valor) {
        if ($valor > 0) {
            $resu += $valor;
        } else {
            // $t[$i] = 0;
            //Con esto lo que hacemos es borrar los númers negativos
            unset($t[$key]);
        }
    }
    /*
    for($i=0; $i < count($t); $i++){
        if($t[$i] > 0){
            $resu += $t[$i];
        }else{
           // $t[$i] = 0;
           //Con esto lo que hacemos es borrar los númers negativos
            unset($t[$i]);
        }
    }
    */
    return $resu;
}

echo "10 + 20 =" . suma(10, 20) . "<br>";
$cosa = 100;
$valor = suma($cosa, 2);
echo "La suma de " . $cosa . " + 2 = " . $valor . "<br>";

$valores = [3, 5, -5, -60, 6, 0, -1, 8];
$valores2 = [3, 5, -5, -60, 6, 0, -1, 8, 35, 2];

echo "Suma de positivos " . sumapos($valores) . "<br>";
echo "Suma de positivos " . sumapos($valores2) . "<br>";
echo "Suma de positivos " . sumaposceros($valores) . "<br>";
echo "Suma de positivos " . sumapos($valores) . "<br>";
print_r($valores);
echo "<br>" . "<br>";
echo " Operar -> suma : " . operar(10, 20, 'suma') . "<br>";
echo  " Operar -> resta : " . operar(10, 20, 'resta') . "<br>";


function compedad(array $v1, array $v2): int
{
    return ($v1[1] - $v2[1]);
};
$datos = [5595 => ["Pepe", 34], 5125 => ["Juan", 23], 5596 => ["Ana", 45]];
uasort($datos, 'compedad');

print_r($datos);
