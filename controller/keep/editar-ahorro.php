<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
    exit();
}

require'./../../controller/bd.php';

$ahorro_id = $_POST['id'] ?? null;
$user_id = $_POST['user_id'] ?? null;
$name = $_POST['name'] ?? null;
$amount = $_POST['amount'] ?? null;
$description = $_POST['description'] ?? null;

if (!$ahorro_id || !$user_id || !$name || !$amount || !$description) {
    echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
    exit();
}

$stmt = $conn->prepare("UPDATE ahorros SET name = :name, amount = :amount, description = :description WHERE id = :id AND user_id = :user_id");
$stmt->bindParam(':id', $ahorro_id, PDO::PARAM_INT);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
$stmt->bindParam(':description', $description, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Ahorro actualizado exitosamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al actualizar el ahorro"]);
}
?>
