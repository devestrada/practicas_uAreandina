<?php
include_once '../conexion.php';

//LEER
$sql_leer = 'SELECT * FROM factura';
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();
$resultado = $gsent->fetchAll();

//AGREGAR
if($_POST){
    $valor = $_POST['valor'];
    $periodo_mes = $_POST['periodo_mes'];
    $fecha_pago = $_POST['fecha_pago'];
    $pago = "No";
    $id_servicio = $_POST['id_servicio'];
    $id_cliente = $_POST['id_cliente'];

    $sql_agregar = 'INSERT INTO factura (valor, periodo_mes, fecha_pago, pago, id_cliente, id_servicio) VALUES (?, ?, ?, ?, ?, ?)';
    $sent_agregar = $pdo->prepare($sql_agregar);
    $sent_agregar->execute(array($valor, $periodo_mes, $fecha_pago, $pago, $id_cliente, $id_servicio));

    //Cerrar conexion base de datos
    $pdo = null;
    $sent_agregar = null;

    header('location:admin_factura.php');
}
//Editar
if($_GET){
    $id_factura = $_GET['id_factura'];

    $sql_unico = 'SELECT * FROM factura WHERE id_factura=?';
    $gsent_unico = $pdo->prepare($sql_unico);
    $gsent_unico->execute(array($id_factura));
    $resultado_unico = $gsent_unico->fetch();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style_admin.css">
    <title>Administracion de facturas</title>
</head>
<body>

<div class="cabecera">
    <h2>Bienvenido a la administración de facturas</h2>
    <p>Cree, lea, actualice y borre las facturas</p>
</div>
<div class="container">
        <div class="factura">
            <?php if(!$_GET): ?>
            <h2>Agregar facturas</h2>
            <form method="POST">
                <label>Identificación del cliente</label>
                <input type="number" name="id_cliente">
                <label>Valor a pagar</label>
                <input type="number" name="valor">
                <label>Periodo de pago</label>
                <select name="periodo_mes">
                    <option value="Enero">Enero</option> 
                    <option value="Febrero">Febrero</option>
                    <option value="Marzo">Marzo</option>
                    <option value="Abril">Abril</option> 
                    <option value="Mayo">Mayo</option>
                    <option value="Junio">Junio</option>
                    <option value="Julio">Julio</option> 
                    <option value="Agosto">Agosto</option>
                    <option value="Septiembre">Septiembre</option>
                    <option value="Octubre">Octubre</option> 
                    <option value="Noviembre">Noviembre</option>
                    <option value="Diciembre">Diciembre</option>
                </select>
                <label>Fecha límite de pago</label>
                <input type="date" name="fecha_pago">
                <label>Servicio</label>
                <select name="id_servicio">
                    <option value="1">Energia eléctrica</option> 
                    <option value="2">Agua potable</option>
                    <option value="3">Gas natural</option>
                </select>
                <button type="submit">Registrar factura</button>
                <a class="verfactura">Ver facturas</a>
            </form>
            <?php endif ?>

            
        </div>

        <div class="ver-factura">
        <a href="./admin_factura.php" class="atras"><ion-icon name="arrow-back-outline"></ion-icon></a>
        <table>
                <tr>
                    <th>Factura</th>
                    <th>Valor a pagar</th>
                    <th>Periodo</th>
                    <th>Fecha</th>
                    <th>Pago realizado</th>
                    <th>Servicio</th>
                    <th>ID Cliente</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach($resultado as $dato): ?>
                    <tr>
                        <td><?php echo $dato['id_factura'] ?></td>
                        <td><?php echo $dato['valor'] ?></td>
                        <td><?php echo $dato['periodo_mes'] ?></td>
                        <td><?php echo $dato['fecha_pago'] ?></td>
                        <td><?php echo $dato['pago'] ?></td>
                        <td><?php echo $dato['id_servicio'] ?></td>
                        <td><?php echo $dato['id_cliente'] ?></td>
                        <td><a class="eliminar" href="./eliminar.php?id_factura=<?php echo $dato['id_factura'] ?>"><ion-icon name="trash-outline"></ion-icon>Eliminar</a></td>
                        <td><a class="editar" href="./admin_factura.php?id_factura=<?php echo $dato['id_factura'] ?>"><ion-icon name="create-outline"></ion-icon>Editar</a></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>

        <?php if($_GET): ?>
        <div class="editar-factura">
            <h2>Editar facturas</h2>
            <form method="GET" action="./editar.php">
                <input type="hidden" name="id_factura" value="<?php echo $resultado_unico['id_factura'] ?>">
                <input type="hidden" name="id_cliente" value="<?php echo $resultado_unico['id_cliente'] ?>">
                <label>Valor a pagar</label>
                <input type="number" name="valor" value="<?php echo $resultado_unico['valor'] ?>">
                <label>Periodo de pago</label>
                <select name="periodo_mes">
                    <option value="Enero">Enero</option> 
                    <option value="Febrero">Febrero</option>
                    <option value="Marzo">Marzo</option>
                    <option value="Abril">Abril</option> 
                    <option value="Mayo">Mayo</option>
                    <option value="Junio">Junio</option>
                    <option value="Julio">Julio</option> 
                    <option value="Agosto">Agosto</option>
                    <option value="Septiembre">Septiembre</option>
                    <option value="Octubre">Octubre</option> 
                    <option value="Noviembre">Noviembre</option>
                    <option value="Diciembre">Diciembre</option>
                </select>
                <label>Fecha límite de pago</label>
                <input type="text" name="fecha_pago" value="<?php echo $resultado_unico['fecha_pago'] ?>">
                <label>Factura pagada</label>
                <select name="pago">
                    <option value="no">No</option>
                    <option value="si">Si</option>
                </select>
                <label>Servicio</label>
                <select name="id_servicio">
                    <option value="1">1: Energia eléctrica</option>
                    <option value="2">2: Agua potable</option>
                    <option value="3">3: Gas natural</option>
                </select>
                <button type="submit">Guardar cambios</button>
            </form>
            
        </div><?php endif ?>
</div>

<div class="pie">
    <p>Aplicativo web desarrollado por: <b>Cristian Estrada A.</b></p>
    <a target="_blanck" href="http://profe-cris.github.io">Mi portafolio web</a>
</div>


<script>
    let factura = document.querySelector('.verfactura');
    let activeFactura = document.querySelector('.ver-factura');

    factura.onclick = function() {
        activeFactura.classList.toggle('active');
    }
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>