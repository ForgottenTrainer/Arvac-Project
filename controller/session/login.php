<?php
require '../bd.php';

session_start();
header('Content-Type: application/json');

// Obtener los datos del formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validar los datos
if (empty($email) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
    exit();
}

// Preparar y ejecutar la declaración para obtener el usuario
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si el usuario existe y la contraseña es correcta
if ($user && password_verify($password, $user['password'])) {
    // Configurar la sesión del usuario
    $_SESSION['user_id'] = $user['id'];

    echo json_encode(["status" => "success", "message" => "Login exitoso"]);
} else {
    echo json_encode(["status" => "error", "message" => "Credenciales incorrectas"]);
}