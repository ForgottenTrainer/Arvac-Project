<?php 
session_start();
require './../../controller/bd.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
    exit();
}


$stmt = $conn->prepare('SELECT * FROM usuarios WHERE id = :id');
$stmt->bindParam(':id', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

