<?php
require_once("BiciElectrica.php");

// Leer el fichero csv y devuelve una tabla de bicicletas
function cargarbicis(): array
{
    $fich = @fopen("Bicis.csv", "r");
    if ($fich == false) {
        die("Error al abrir el fichero");
    }
    $tabla = [];

    while ($valor = fgetcsv($fich)) {
        list($id, $cx, $cy, $bat, $op) = $valor;
        $bici = new BiciElectrica($id, $cx, $cy, $bat, $op);
        $tabla[] = $bici;
    }

    return $tabla;
}

// Devuelve una cadena con la tabla html de bicis operativas
function mostrartablabicis($tabla): string
{
    $cadena = "<table><tr><th>Id</th><th>Coord X</th><th>Cood Y</th><th>Bateria</th></tr>";
    foreach ($tabla as $bici){
    $bici->id  ;  
    $cadena .= "<td>".$bici."</td>";
        
        
    }
    $cadena .="</table>";

    return $cadena;
}


/**
 * Devuelve la bici con menor distancia a las coordenadas de usuario. 
 * Llamar a la función distancia
 * @param $tabla - tabla de bicicletas
 * @param $x - Coordenada x de usuario
 * @param $y - Coordenada x de usuario
 * @return bicicleta más cercana o null
 */
function bicimascercana($tabla, $x, $y)
{
    $bicicerca = null;
    
    return $bicicerca;
}

