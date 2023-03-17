<?php
include_once './conexion.php';

$consulta = 'SELECT * FROM factura';

$busqueda = null;
if (isset($_GET['id_factura'])) {
    $busqueda = $_GET['id_factura'];
    $consulta = 'SELECT * FROM factura WHERE id_factura=?';
}
if (isset($_GET['id_cliente'])) {
    $busqueda = $_GET['id_cliente'];
    $consulta = 'SELECT * FROM factura WHERE id_cliente=?';
}

$sentencia = $pdo->prepare($consulta, [
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
]);
if ($busqueda === null) {
    $sentencia->execute();
} else {
    $parametros = [$busqueda];
    $sentencia->execute($parametros);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Paga tus servicios en linea</title>
</head>
<body>
    
<div class="cabecera">
    <h2>Bienvenido</h2>
    <p>Consulte y pague sus facturas de servicios</p>
    <div class="link">
        <a href="./cliente/admin_cliente.php" target="_blanck">Clientes</a>
        <a href="./factura/admin_factura.php" target="_blanck">Facturas</a>
    </div>
</div>
<div class="container">
    <div class="busqueda">
        <h2>Buscar factura</h2>
            <form method="GET">
                <label>Buscar por identificación del cliente</label>
                <input type="number" name="id_cliente">
                <button type="submit">Buscar factura</button>
            </form>
            <form method="GET">
                <label>Buscar por código de factura</label>
                <input type="number" name="id_factura">
                <button type="submit">Buscar factura</button>
            </form>
    </div>
    <div class="ver-factura">
            <h2>Factura</h2>
            <?php if($_GET): ?>
                <table>
                <tr>
                    <th>Factura</th>
                    <th>Valor a pagar</th>
                    <th>Periodo</th>
                    <th>Fecha</th>
                    <th>Pagada</th>
                    <th>Servicio</th>
                    <th>ID Cliente</th>
                    <th></th>
                </tr>
                <?php while ($pfactura = $sentencia->fetchObject()): ?>
                    <tr>
                        <td><?php echo $pfactura->id_factura ?></td>
                        <td><?php echo $pfactura->valor ?></td>
                        <td><?php echo $pfactura->periodo_mes ?></td>
                        <td><?php echo $pfactura->fecha_pago ?></td>
                        <td><?php echo $pfactura->pago ?></td>
                        <td><?php echo $pfactura->id_servicio ?></td>
                        <td><?php echo $pfactura->id_cliente ?></td>
                        <td><a class="pagar" href="./pagar.php?id_factura=<?php echo $pfactura->id_factura ?>"><ion-icon name="cash-outline"></ion-icon>Pagar</a></td>
                    </tr>
                <?php endwhile ?>
            </table>
            <?php endif ?>
            
    </div>
</div>

<div class="pie">
    <p>Aplicativo web desarrollado por: <b>Cristian Estrada A.</b></p>
    <a target="_blanck" href="http://profe-cris.github.io">Mi portafolio web</a>
</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>