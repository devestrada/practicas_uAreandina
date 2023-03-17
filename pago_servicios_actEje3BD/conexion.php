<?php
$link = 'mysql:host=localhost;dbname=pago_servicios';
$user = 'root';

try {
    $pdo = new PDO($link, $user);
    //echo "Conectado";

}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}