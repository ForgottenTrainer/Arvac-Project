<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
    exit();
}

require'./../../controller/bd.php';

$ingreso_id = $_POST['ingreso_id'] ?? null;
$amount = $_POST['amount'] ?? null;
$description = $_POST['description'] ?? '';

if (!$ingreso_id || !$amount || $description === '') {
    echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
    exit();
}

$stmt = $conn->prepare("UPDATE ingresos SET amount = :amount, description = :description WHERE id = :id");
$stmt->bindParam(':id', $ingreso_id, PDO::PARAM_INT);
$stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
$stmt->bindParam(':description', $description, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Ingreso actualizado exitosamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al actualizar el ingreso"]);
}
