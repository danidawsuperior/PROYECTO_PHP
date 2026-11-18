<?php


//session_start();

require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';


$mensajeError = " ";
$plazas = htmlspecialchars($_GET['plazas']);
$destino = htmlspecialchars($_GET['destino']);

if (!is_numeric($plazas) || $plazas <= 0 || $plazas > 5) {
    $mensajeError = "ERROR: El Nº de plazas no es correcto debe ser entre 1 y 5";
    include 'vistas/error.php';
    die();
}

$ac = AccesoDatos::initModelo();
$hayVuelo = $ac->hayVuelo($destino);

if(! $hayVuelo){
    $mensajeError = "ERROR: no hay vuelos con destino ".$destino;
    include 'vistas/error.php';
    die();
}

// ACTUALIZO EL COOKIE SI LA CONSULTA ES CORRECTAS
$nconsultas = 0;
if(isset($_COOKIE['consultas'])){
    $nconsultas = $_COOKIE['consultas'];
}
$nconsultas ++;
// Hay que indicar la ruta  / para que permita desde cualquier lugar del servidor
setcookie('consultas',$nconsultas, time()+3600*24*7, "/");


$listaVuelos = $ac->getVuelos($destino,$plazas);
if(count($listaVuelos) == 0){
    $mensajeError = "ERROR: no hay vuelos con plazas disponibles con destino ".$destino;
    include 'vistas/error.php';
    die();
}

include 'vistas/listado.php';

