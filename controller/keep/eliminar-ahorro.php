<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
    exit();
}

require'./../../controller/bd.php';

$ingreso_id = $_POST['ingreso_id'] ?? null;

if (!$ingreso_id) {
    echo json_encode(["status" => "error", "message" => "ID de ingreso no proporcionado"]);
    exit();
}

$stmt = $conn->prepare("DELETE FROM ingresos WHERE id = :id");
$stmt->bindParam(':id', $ingreso_id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Ingreso eliminado exitosamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al eliminar el ingreso"]);
}