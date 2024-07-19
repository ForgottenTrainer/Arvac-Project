<?php

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
    exit();
}

require './../../controller/bd.php';

$user_id = $_POST['user_id'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$profile_pic = $_FILES['profile_pic'] ?? null;

if (!$user_id || !$nombre || !$email || !$password) {
    echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
    exit();
}

$profile_pic_url = null;
if ($profile_pic && $profile_pic['error'] == 0) {
    if ($profile_pic['size'] > 1048576) {
        echo json_encode(["status" => "error", "message" => "El tamaño de la foto de perfil no debe superar 1 MB"]);
        exit();
    }

    $upload_dir = __DIR__ . '/../../public/img/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $fecha = new DateTime();
    $unique_name = $fecha->getTimestamp() . "_" . $_FILES['profile_pic']['name'];
    $profile_pic_path = $upload_dir . $unique_name;
    $profile_pic_url = '/public/img/' . $unique_name;

    if (!move_uploaded_file($profile_pic['tmp_name'], $profile_pic_path)) {
        echo json_encode(["status" => "error", "message" => "Error al subir la foto de perfil"]);
        exit();
    }
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET nombre = :nombre, email = :email, password = :password";
if ($profile_pic_url) {
    $sql .= ", perfil = :perfil";
}
$sql .= " WHERE id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
if ($profile_pic_url) {
    $stmt->bindParam(':perfil', $profile_pic_url, PDO::PARAM_STR);
}

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Información del usuario actualizada exitosamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al actualizar la información del usuario"]);
}