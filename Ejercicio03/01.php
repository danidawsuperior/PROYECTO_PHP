<!--
Rellenar un array con 20 números aleatorios entre 1 y 10 y mostrar el contenido del array  
mediante una tabla de una fila en HMTL. Mostrar a continuación el valor máximo, el mínimo 
y el  valor que mas veces se repite. (Nota definir funciones para cada caso)
-->
<?php
        function num_aleatorio(){
            $lista = [];
            for($i=0; $i<20;$i++){
                $lista[] = rand(1,10);
            }
            return $lista;
        }

        function num_max(array $lista){
            $max = $lista[0];
            for($i=1;$i<count($lista);$i++){
                if($lista[$i] > $max){
                    $max = $lista[$i];
                }
            }
            return $max;
        }

        function num_min(array $lista){
            $min = $lista[0];
            for($i=1;$i<count($lista);$i++){
                if($lista[$i] < $min){
                    $min = $lista[$i];
                }
            }
            return $min;
        }

        function moda(array $lista){
            $numero_mas_repetido = $lista[0];
            $contador_repetidos = 0;
            for($i=0;$i<count($lista);$i++){
                $contador = 0;
                for($j=0;$j<count($lista);$j++){
                    if($lista[$i] == $lista[$j]){
                        $contador++;
                    }
                }
                if($contador>$contador_repetidos){
                    $contador_repetidos = $contador;
                    $numero_mas_repetido = $lista[$i];
                }
            }
            return $numero_mas_repetido;
        }

        $array_datos = num_aleatorio();

        $valor_maximo = num_max($array_datos);
        $valor_minimo = num_min($array_datos);
        $valor_moda = moda($array_datos);
        
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Contenido del array</h2>
    <p>
    <table style='border: 1px solid black; border-collapse';>
        <tr>
            <?php for($i=0;$i<count($array_datos);$i++): ?>
                <td style='border: 1px solid black; padding: 5px';><?= $array_datos[$i] ?> </td>
                
            <?php endfor ?>
        </tr>
    </table>
    </p>
    <br>Número máximo = <?= $valor_maximo ?>
    <br>Número mínimo = <?= $valor_minimo ?>
    <br>Moda = <?= $valor_moda ?>
</body>
</html>