<?php 

include_once '../conexion.php';

$id_cliente = $_GET['id_cliente'];

$sql_eliminar = 'DELETE FROM cliente WHERE id_cliente=?';
$sent_eliminar = $pdo->prepare($sql_eliminar);
$sent_eliminar->execute(array($id_cliente));

//Cerrar conexion base de datos
$pdo = null;
$sent_eliminar = null;

header('location:admin_cliente.php');