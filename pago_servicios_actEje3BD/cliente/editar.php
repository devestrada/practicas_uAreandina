<?php
include_once '../conexion.php';

$id_cliente = $_GET['id_cliente'];
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$telefono = $_GET['telefono'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];
$departamento = $_GET['departamento'];
$ciudad = $_GET['ciudad'];
$estrato = $_GET['estrato'];
$id_servicio = $_GET['id_servicio'];

$sql_editar = 'UPDATE cliente SET nombre=?,apellido=?,telefono=?,email=?,direccion=?,departamento=?,ciudad=?,estrato=?,id_servicio=? WHERE id_cliente=?';
$sent_editar = $pdo->prepare($sql_editar);
$sent_editar->execute(array($nombre,$apellido,$telefono,$email,$direccion,$departamento,$ciudad,$estrato,$id_servicio,$id_cliente));

//Cerrar conexion base de datos
$pdo = null;
$sent_editar = null;

header('location:admin_cliente.php');