<?php 
require './../controller/bd.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
    exit();
}

$stmt = $conn->prepare('SELECT * FROM ahorros WHERE user_id = :id ORDER BY id DESC LIMIT 1 ');
$stmt->bindParam(':id', $_SESSION['user_id']);
$stmt->execute();
$ahorro = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare('SELECT * FROM ingresos WHERE ahorro_id = :ahorro_id ORDER BY id DESC LIMIT 1');
$stmt2->bindParam(':ahorro_id', $ahorro['id']);
$stmt2->execute();
$ingreso = $stmt2->fetch(PDO::FETCH_ASSOC);