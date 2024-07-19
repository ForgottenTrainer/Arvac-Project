<?php

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
    exit();
}

require'./../../controller/bd.php';

$ahorro_id = $_POST['ahorro_id'] ?? null;
$amount = $_POST['amount'] ?? null;
$description = $_POST['description'] ?? '';

if (!$ahorro_id || !$amount) {
    echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
    exit();
}

$stmt = $conn->prepare("INSERT INTO ingresos (ahorro_id, amount, description) VALUES (:ahorro_id, :amount, :description)");
$stmt->bindParam(':ahorro_id', $ahorro_id, PDO::PARAM_INT);
$stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
$stmt->bindParam(':description', $description, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Ingreso registrado exitosamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al registrar el ingreso"]);
}