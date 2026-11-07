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
    foreach ($tabla as $bici) {
        $cadena .= "<tr>";
        $cadena .= "<td>" .$bici->id. "</td>";
        $cadena .= "<td>" .$bici->coordx. "</td>";
        $cadena .= "<td>" .$bici->coordy. "</td>";
        $cadena .= "<td>" .$bici->bateria. "</td>";
        $cadena .= "</tr>";
    }
    $cadena .= "</table>";
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
function bicimascercana($x, $y, $tabla)
{
    if(empty($tabla)){
        return null;
    }

    $bicicerca = null;
    $distanciaminima = 9999999;

    foreach($tabla as $bici){

        $distanciabiciactual = $bici->distancia($x,$y);

        if($distanciabiciactual < $distanciaminima){
            $distanciaminima = $distanciabiciactual;
            $bicicerca = $bici;
        }
    }
    

    return $bicicerca;
}
