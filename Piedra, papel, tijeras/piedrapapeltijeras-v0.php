<?php
// JUEGO DE PIEDRA, PAPEL Y TIJERAS VERSION INCOMPLETA
//-------------------------------
// Caracteres asociadas a las logos 
// PIEDRA (Puño derecho)
// PIEDRA2 (Puño Izquierdo / jugador 2 ) 
define ('PIEDRA',   "&#x1F91C;");
define ('PIEDRA2',  "&#x1F91B;");
define ('TIJERAS',  "&#x1F596;");
define ('PAPEL',    "&#x1F91A;" );

// Tabla de mensajes en función del ganador
$tmsg = [
          "¡Empate !",
          " Ha ganado el jugador 1",
          " Ha ganado el jugador 2"
        ];


/**
 *  Calcula el ganador 
 *  Parámetros: Dos valores PIEDRA, PAPEL O TIJERA
 *  Resultado: 0 (Empate),1 (1 Gana jugador 1), 2 (Gana jugador 2)   
 *  
 */

function calcularGanador (String $valor1, String $valor2): int{
    // COMPLETAR
    if($valor1 == PIEDRA ){
      if($valor2 == PIEDRA) return 0;
      if($valor2 == TIJERAS) return 1;
      if($valor2 == PAPEL) return 2;
    } else  if($valor1 == PAPEL ){
      if($valor2 == PIEDRA) return 1;
      if($valor2 == TIJERAS) return 2;
      if($valor2 == PAPEL) return 0;
    } else if($valor1 == TIJERAS ){
      if($valor2 == PIEDRA) return 2;
      if($valor2 == TIJERAS) return 0;
      if($valor2 == PAPEL) return 1;
    }
    return 0;
}
/**
 *  Obtiene un valor aleatorio PIEDRA, PAPEL O TIJERAS
 * @return string
 */
function obtenerFicha (): string {
   // COMPLETAR
   $ficha = random_int(1,3);
    if($ficha == 1) return PIEDRA;
    if($ficha == 2) return TIJERAS;
    if($ficha == 3) return PAPEL;
   return PAPEL;
  }


$jugador1 = obtenerFicha();
$jugador2 = obtenerFicha();
$pos = calcularGanador($jugador1,$jugador2);
$mensaje =  $tmsg[$pos]; 

// Si el jugador 2 saca piedra, se cambia el símbolo para que sea el puño izquierdo
$jugador2 = ($jugador2 == PIEDRA)?PIEDRA2:$jugador2;

?>

<html>
<head>
<title>Online PHP Script Execution</title>
</head>
<body>
<h1>¡Piedra, papel, tijera!</h1>

    <p>Actualice la página para mostrar otra partida.</p>

    <table>
      <tr>
        <th>Jugador 1</th>
        <th>Jugador 2</th>
      </tr>
      <tr>
        <td><span style="font-size: 7rem"><?= $jugador1; ?></span></td>
        <td><span style="font-size: 7rem"><?= $jugador2; ?></span></td>
      </tr>
      <tr>
        <th colspan="2"><?= $mensaje ?></th>
      </tr>
    </table>
</body>
</html>