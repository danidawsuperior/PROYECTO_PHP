<h1>Caso Switch 1</h1>
<?php
$autonomia = 'Cataluña' ; $provincias = array();
switch ($autonomia) {
case 'Aragon' :

$provincias[]='Huesca';
$provincias[]='Zaragoza';
$provincias[]='Teruel';

case 'Cataluña' :

$provincias[]='Barcelona';
$provincias[]='Tarragona';
$provincias[]='Lerida';
$provincias[]='Gerona';

default:

$provincias[]='Caceres';
$provincias[]='Badajoz';

}
var_dump($provincias);
?>

<h1>Caso Switch 2</h1>
<?php
$autonomia = 'Aragon' ; $provincias = array();
switch ($autonomia) {
case 'Aragon' :

$provincias[]='Huesca';
$provincias[]='Zaragoza';
$provincias[]='Teruel';

break;
case 'Cataluña' :

$provincias[]='Barcelona';
$provincias[]='Tarragona';
$provincias[]='Lerida';
$provincias[]='Gerona';

break;
default:

$provincias[]='Caceres';
$provincias[]='Badajoz';

}
var_dump($provincias);

?>

<h1>Caso Switch 3</h1>
<?php // Retribuciones en especie para empleados
$puesto = 'Jefe de obra'; $regalos = array();
switch($puesto) {
case 'Promotor':
$regalos[] = 'automovil' ;
case 'Arquitecto':
case 'Aparejador':
$regalos[] = 'Vacaciones en el Caribe';
break;
case 'Jefe de obra':
$regalos[] = 'Abono Real Madrid';
case 'Oficial':
$regalos[] = 'Jamón serrano';
default:
$regalos[] = 'Botella de vino';
}
var_dump($regalos);
?>

<h1>Caso operador ? 1</h1>
<?php
$edad=17;
$mensaje = $edad>=18 ? 'Mayor de edad' : 'Menor de edad';
echo $mensaje ."<br><br>";
// También sería válido el siguiente código
echo $edad>=18 ? 'Mayor de edad' : 'Menor de edad';
?>

<h1>Caso Do-While 1</h1>
<?php
$comision =0;
$cantidad =3000;
do
{ $comision +=10;
$cantidad -=1000;
} while ( $cantidad >= 0 ) ;
echo $comision ."<br>";
echo $cantidad;
?>

<h1>Caso for 1</h1>
<?php
$cantidad=3000;
for ($comision = 0 ; $cantidad >= 0 ; $comision+=10)
{ $cantidad -= 1000 ; }
echo $comision;
?>

<h1>Caso for 2</h1>
<?php
$k=1;
//for ( ; ; ) { echo $k++ , '<br>' ; }
echo $k;
?>

<h1>Caso foreach 1</h1>
<?php
$notas = array( 'FOL'=>6.5 , 'Java'=>7.2 , 'Ingles'=>9.8) ;
foreach ( $notas as $indice => $valor) {
echo " La calificación en $indice es $valor <br/>" ;
}
?>