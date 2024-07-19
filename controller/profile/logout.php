<?php
session_start();
header('Content-Type: application/json');

// Destruir todas las variables de sesión.
$_SESSION = array();

// Si se desea destruir la sesión completamente, también se debe borrar la cookie de sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();

// Responder con un mensaje JSON.
echo json_encode(["status" => "success", "message" => "Sesión cerrada exitosamente"]);