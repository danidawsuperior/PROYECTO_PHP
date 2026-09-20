<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $numero_azar = random_int(1,9);
        echo "Número generado " .$numero_azar ."<br>";

        for($i=1; $i<=$numero_azar; $i++){
            for($j=$i; $j<=$i; $j++){
                echo $i ."<br>";
                echo $j;
            };
        };
    ?>
</body>
</html>