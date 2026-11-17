<?php
session_start();

require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';


$plazas = htmlspecialchars($_GET['plazas']);
$destino = htmlspecialchars($_GET['destino']);

$mensajeError="";
if (!is_numeric($plazas) || $plazas <= 0 || $plazas > 5) {
    $mensajeError = "ERROR: El Nº de plazas no es correcto debe ser entre 1 y 5";
    include 'vistas/error.php';
    die();
}

$ac = AccesoDatos::initModelo();

if(! $ac->hayVuelo($destino)){
    $mensajeError = "ERROR: no hay vuelos con destino ".$destino;
    include 'vistas/error.php';
    die();
}

$listaVuelos = $ac->getVuelos($destino,$plazas);
if(count($listaVuelos) == 0){
    $mensajeError = "ERROR: no hay vuelos con destino ".$destino;
    include 'vistas/error.php';
    die();
}

include 'vistas/listado.php';

