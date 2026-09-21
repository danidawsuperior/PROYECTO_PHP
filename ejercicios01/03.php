<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piramide</title>
</head>
<body>
    <?php
        
        $numero_azar = random_int(1,9);
        echo "Número generado " .$numero_azar ."<br>";
        
        $asteriscos = 1;
        $espacios_blanco = $numero_azar - 1 ;

        echo "<code>";
        for($i=1;$i<=$numero_azar;$i++){
            
            for($j=1;$j<=$espacios_blanco;$j++){
                echo " " ;
            }
           
            for($k=1;$k<=$asteriscos;$k++){
                echo "*";
            }
            echo "<br>";
            $espacios_blanco = $espacios_blanco - 1;
            $asteriscos = $asteriscos + 2;
        }
        echo "</code>";
        
    ?>
</body>
</html>