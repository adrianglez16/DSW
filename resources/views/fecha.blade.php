<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Fecha</h2>
<?php
// echo "$day $month $year";


$fechas = array();


$fecha = compact('day', 'month', 'year', $fechas);
print_r($fecha);

?>
</body>
</html>