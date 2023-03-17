<?php
include_once '../conexion.php';

$id_factura = $_GET['id_factura'];
$valor = $_GET['valor'];
$periodo_mes = $_GET['periodo_mes'];
$fecha_pago = $_GET['fecha_pago'];
$pago = $_GET['pago'];
$id_servicio = $_GET['id_servicio'];
$id_cliente = $_GET['id_cliente'];

$sql_editar = 'UPDATE factura SET valor=?,periodo_mes=?,fecha_pago=?,pago=?,id_servicio=?,id_cliente=? WHERE id_factura=?';
$sent_editar = $pdo->prepare($sql_editar);
$sent_editar->execute(array($valor,$periodo_mes,$fecha_pago,$pago,$id_servicio,$id_cliente,$id_factura));

//Cerrar conexion base de datos
$pdo = null;
$sent_editar = null;

header('location:admin_factura.php');