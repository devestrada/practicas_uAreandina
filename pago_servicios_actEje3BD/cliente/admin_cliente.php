<?php
include_once '../conexion.php';

//LEER
$sql_leer = 'SELECT * FROM cliente';
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();
$resultado = $gsent->fetchAll();

//AGREGAR
if($_POST){
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];
    $estrato = $_POST['estrato'];
    $id_servicio = $_POST['id_servicio'];

    $sql_agregar = 'INSERT INTO cliente (id_cliente, nombre, apellido, telefono, email, direccion, departamento, ciudad, estrato, id_servicio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $sent_agregar = $pdo->prepare($sql_agregar);
    $sent_agregar->execute(array($id_cliente, $nombre, $apellido, $telefono, $email, $direccion, $departamento, $ciudad, $estrato, $id_servicio));

    //Cerrar conexion base de datos
    $pdo = null;
    $sent_agregar = null;

    header('location:admin_cliente.php');
}
//Editar
if($_GET){
    $id_cliente = $_GET['id_cliente'];

    $sql_unico = 'SELECT * FROM cliente WHERE id_cliente=?';
    $gsent_unico = $pdo->prepare($sql_unico);
    $gsent_unico->execute(array($id_cliente));
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
    <title>Administracion de clientes</title>
</head>
<body>

<div class="cabecera">
    <h2>Bienvenido a la administración de clientes</h2>
    <p>Cree, lea, actualice y borre las facturas</p>
</div>
    <div class="container">

        <div class="cliente">
            <?php if(!$_GET): ?>
            <h2>Agregar clientes</h2>
            <form method="POST">
                <div>
                    <label>Identificación</label>
                    <input type="number" name="id_cliente">
                    <label>Nombres</label>
                    <input type="text" name="nombre">
                    <label>Apellidos</label>
                    <input type="text" name="apellido">
                    <label>Teléfono</label>
                    <input type="number" name="telefono">
                    <label>Correo eléctronico</label>
                    <input type="email" name="email">
                </div>
                <div>
                    <label>Dirección</label>
                    <input type="text" name="direccion">
                    <label>Departamento</label>
                    <input type="text" name="departamento">
                    <label>Ciudad</label>
                    <input type="text" name="ciudad">
                    <label>Estrato</label>
                    <input type="number" name="estrato">
                    <label>Servicio</label>
                    <select name="id_servicio">
                        <option value="1">1: Energia eléctrica</option> 
                        <option value="2">2: Agua potable</option>
                        <option value="3">3: Gas natural</option>
                    </select>
                    <button type="submit">Registrar cliente</button>
                </div>
                <a class="vercliente">Ver clientes</a>
            </form>
            <?php endif ?>

            
        </div>

        <div class="ver-cliente">
            <a href="./admin_cliente.php" class="atras"><ion-icon name="arrow-back-outline"></ion-icon></a>
            <table>
                <tr>
                    <th>Identificación</th>
                    <th>Cliente</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Estrato</th>
                    <th>Servicio</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach($resultado as $dato): ?>
                    <tr>
                        <td><?php echo $dato['id_cliente'] ?></td>
                        <td><?php echo $dato['nombre']," ",$dato['apellido'] ?></td>
                        <td><?php echo $dato['telefono'] ?></td>
                        <td><?php echo $dato['email'] ?></td>
                        <td><?php echo $dato['direccion']," ",$dato['departamento']," ",$dato['ciudad'] ?></td>
                        <td><?php echo $dato['estrato'] ?></td>
                        <td><?php echo $dato['id_servicio'] ?></td>
                        <td><a class="eliminar" href="./eliminar.php?id_cliente=<?php echo $dato['id_cliente'] ?>"><ion-icon name="trash-outline"></ion-icon>Eliminar</a></td>
                        <td><a class="editar" href="./admin_cliente.php?id_cliente=<?php echo $dato['id_cliente'] ?>"><ion-icon name="create-outline"></ion-icon>Editar</a></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>

        <div class="editar-cliente">
            <?php if($_GET): ?>
            <h2>Editar clientes</h2>
            <form method="GET" action="./editar.php">
                <div>
                <input type="hidden" name="id_cliente" value="<?php echo $resultado_unico['id_cliente'] ?>">
                <label>Nombre</label>
                <input type="text" name="nombre" value="<?php echo $resultado_unico['nombre'] ?>">
                <label>Apellidos</label>
                <input type="text" name="apellido" value="<?php echo $resultado_unico['apellido'] ?>">
                <label>Teléfono</label>
                <input type="number" name="telefono" value="<?php echo $resultado_unico['telefono'] ?>">
                <label>Correo eléctronico</label>
                <input type="email" name="email" value="<?php echo $resultado_unico['email'] ?>">
                </div>
                <div>
                <label>Dirección</label>
                <input type="text" name="direccion" value="<?php echo $resultado_unico['direccion'] ?>">
                <label>Departamento</label>
                <input type="text" name="departamento" value="<?php echo $resultado_unico['departamento'] ?>">
                <label>Ciudad</label>
                <input type="text" name="ciudad" value="<?php echo $resultado_unico['ciudad'] ?>">
                <label>Estrato</label>
                <input type="number" name="estrato" value="<?php echo $resultado_unico['estrato'] ?>">
                <label>Servicio</label>
                <select name="id_servicio">
                    <option value="1">Energia eléctrica</option>
                    <option value="2">Agua potable</option>
                    <option value="3">Gas natural</option>
                </select>
                <button type="submit">Guardar cambios</button>
                </div>
            </form>
            <?php endif ?>
        </div>
        
    </div>

<div class="pie">
    <p>Aplicativo web desarrollado por: <b>Cristian Estrada A.</b></p>
    <a target="_blanck" href="http://profe-cris.github.io">Mi portafolio web</a>
</div>

<script>
    let cliente = document.querySelector('.vercliente');
    let activeCliente = document.querySelector('.ver-cliente');

    cliente.onclick = function() {
        activeCliente.classList.toggle('active');
    }
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>