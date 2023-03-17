<?php 

include_once '../conexion.php';

$id_factura = $_GET['id_factura'];

$sql_eliminar = 'DELETE FROM factura WHERE id_factura=?';
$sent_eliminar = $pdo->prepare($sql_eliminar);
$sent_eliminar->execute(array($id_factura));

//Cerrar conexion base de datos
$pdo = null;
$sent_eliminar = null;

header('location:admin_factura.php');