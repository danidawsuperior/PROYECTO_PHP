<?php
session_start();

// Cambiar  visitar --> VALOR DE COOKIE  $_COOKIE['visitas'] 
// Cambiar disponible --> VALOR DE SESSION
$msg = "";

// Esto comprueba que el usuario haya introducido una cantidad inicial
if (isset($_POST['cantidadini']) && $_POST['cantidadini'] !== '') {
  $_SESSION['disponible'] = $_POST['cantidadini'];
}

// Actualizo el cookie de visitas
if (!isset($_POST['disponible'])) {
  // Comprueba si existe alguna visita, si hay pone el número de visitas que llevara, sino se pone 1
  $visitas = isset($_COOKIE['visitas']) ? $_COOKIE['visitas'] : 1;

  //Esto hace que si no inserta una cantidad inicial de dinero y se refresca la página no aumente el número de visitas
  if (isset($_POST['cantidadini'])) {
    $visitas++;
    // Guardamos las cookies para que expiren en un mes (segundos*minutos*horas*dias)  
    setcookie('visitas', $visitas, time() + (60 * 60 * 24 * 30));
  }
}


// Entra en el casino --------------------------------
if (! isset($_SESSION['disponible'])) {
  require_once("form_bienvenida.php");
  // No continuo despues de mostrar los formularios
  exit();
}

//Ponemos en esta variable el valor que ha introducido de dinero inicial el usuario
$disponible = $_SESSION['disponible'];



// Si realiza una apuesta ----------------------------------
// llama a procesar apuesta 
if (isset($_POST["apostar"])) {
  $cantidad = (int) $_POST['cantidad'];
  $tipo_apuesta = $_POST['apuesta'];
  $msgresultado = procesarApuesta($cantidad, $disponible, $tipo_apuesta);

  $_SESSION['disponible'] = $disponible;

  $msg =  $msgresultado;
}

// Si abandona o ya no le queda dinero -------------------------
if (isset($_POST["dejar"]) || ($_SESSION["disponible"] == 0)) {
  require_once("despedida.php");

  session_destroy();
  exit();
}
// Muestro el formulario si puede seguir apostando
require_once  "form_apuesta.php";
?>


<?php

/**
 *  FUNCIONES AUXILIARES
 */

function procesarApuesta(int $valorapuesta, int &$saldodisponible, string $apuesta): String
{
  $msgresultado = "";
  //Generamos un valor entre 0 y 1 para que salga par o impar, comproabmos que no sea 0 y que no se supere el valor de la apuesta
  $resultadoaleatorio = rand(0, 1);
  if ($valorapuesta <= 0) {
    $msgresultado = "Error, introduzca un valor mayor que 0";
  } else if ($valorapuesta > $saldodisponible) {
    $msgresultado = "Error, no dispone de " . $valorapuesta . " euros disponibles.";
  } else {
    if ($resultadoaleatorio == 0) {
      $solucion = "PAR";
    } else {
      $solucion = "IMPAR";
    }
    if ($solucion == $apuesta) {
      $msgresultado = " Resultado de la apuesta " . $solucion . "</br>" . "GANASTE";
      $saldodisponible += $valorapuesta;
    } else {
      $msgresultado = " Resultado de la apuesta " . $solucion . "</br>" . "PERDISTE";
      $saldodisponible -= $valorapuesta;
    }
  }
  return $msgresultado;
}
