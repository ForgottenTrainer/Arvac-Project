<?php
session_start();
require './../../controller/bd.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
    exit();
}

$ahorro_id = $_GET['id'] ?? null;

if (!$ahorro_id) {
    echo "ID de ahorro no proporcionado.";
    exit();
}

$stmt = $conn->prepare('SELECT * FROM ahorros WHERE id = :id');
$stmt->bindParam(':id', $ahorro_id);
$stmt->execute();
$ahorro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ahorro) {
    echo "Ahorro no encontrado.";
    exit();
}