<?php
require_once "Cliente.php";
require_once "Pedido.php";
require_once "AccesoDatos.php";


$mensajeError = "";
$codigo_cliente = $_GET['cod_cliente'];
$nombre_cliente = $_GET['nombre'];
$clave_cliente = $_GET['clave'];

if (empty($_GET['nombre']) || empty($_GET['clave'])){
    $mensajeError = " ERROR: Debes rellenar el formulario";
    include 'vistaerror.php';
    exit();

}

$ac = AccesoDatos::initModelo();

$hayCliente = $ac->hayCliente($nombre_cliente, $clave_cliente);

if (!$hayCliente){
    $mensajeError = "ERROR: No hay clientes con estos datos ".$nombre_cliente;
    include 'vistaerror.php';
    die();
}

//Hacer GetId para transformar de nombre a id

$listaPedidos = $ac->getPedidos($codigo_cliente);

if ( count($listaPedidos) == 0){
    $mensajeError = " ERROR: No hay pedidos para el cliente ".$codigo_cliente;
    include 'vistaerror.php';
    die();
} 

include 'vistapedidos.php';


/*
ac->actualizarAccesoCliente();

*/
?>