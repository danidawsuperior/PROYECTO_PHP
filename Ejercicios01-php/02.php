<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escalera</title>
</head>
<body>
    <?php
        $numero_azar = random_int(1,9);
        echo "Número generado " .$numero_azar ."<br>";

        for($i=1; $i<=$numero_azar; $i++){
            if($i%2 != 0){
                $color = "blue";
            } else {
                $color = "red";
            }

            echo "<font color='$color'>";

            for($j=1; $j<=$i; $j++){
                echo $i;
                
            };
            echo "</font><br>";
        };
    ?>
</body>
</html>