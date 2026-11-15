<?php

// MUESTRA TODOS LOS USUARIOS
function mostrarDatos (){
    
    $titulos = [ "Codigo","Nombre","Stock","Stock_min","Precio"];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    for ($j=0; $j < count($titulos); $j++){
        $msg .= "<th>$titulos[$j]</th>";
    }  
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $db = AccesoDatos::getModelo();
    $tproducto = $db->getProductos();
    foreach ($tproducto as $producto) {
        $msg .= "<tr>";
        $msg .= "<td>$producto->codigo</td>";
        $msg .= "<td>$producto->nombre</td>";
        $msg .= "<td>$producto->stock</td>";
        $msg .= "<td>$producto->stock_min</td>";
        $msg .= "<td>$producto->precio</td>";
        $msg .="<td><a href=\"#\" onclick=\"confirmarBorrar('$producto->codigo','$producto->nombre');\" >🗑️</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Modificar&codigo=$producto->codigo\">✏️</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Detalles&codigo=$producto->codigo\" >👁️</a></td>\n";
        $msg .="</tr>\n";
        
    }
    $msg .= "</table>";
   
    return $msg;    
}

/*
 *  Funciones para limpiar la entreda de posibles inyecciones
 */

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
 
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}

