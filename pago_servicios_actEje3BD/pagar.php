<?php
include_once './conexion.php';

$id_factura = $_GET['id_factura'];
$pago = "si";
//Pagar
$sql_editar = 'UPDATE factura SET pago=? WHERE id_factura=?';
$sent_editar = $pdo->prepare($sql_editar);
$sent_editar->execute(array($pago,$id_factura));

//Cerrar conexion base de datos
$pdo = null;
$sent_editar = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Pago de factura</title>
</head>
<body>
    <div class="pago">
        <p>La factura se ha pagado</p>
        <a href="./index.php">Volver</a>
    </div>
</body>
</html>