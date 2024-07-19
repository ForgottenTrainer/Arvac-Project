<?php

session_start();
header('Content-Type: application/json');

require './../bd.php';


try {
    // Asegúrate de que $conn está definido correctamente en bd.php
    if (!$conn) {
        throw new Exception('Error en la conexión a la base de datos');
    }

    $user_id = $_POST['id_user'] ?? null;
    $name = $_POST['name'] ?? null;
    $amount = $_POST['amount'] ?? null;
    $description = $_POST['description'] ?? null;

    if (empty($user_id) || empty($name) || empty($amount) || empty($description)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
        exit();
    }

    // Iniciar una transacción
    $conn->beginTransaction();

    // Insertar el nuevo ahorro
    $stmt = $conn->prepare("INSERT INTO ahorros (user_id, name, amount, description) VALUES (:user_id, :name, :amount, :description)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':description', $description);

    if (!$stmt->execute()) {
        throw new Exception("Error al registrar el ahorro");
    }

    $ahorro_id = $conn->lastInsertId();

    // Generar código único para la sala
    $codigo_sala = uniqid();

    // Insertar la nueva sala
    $stmt2 = $conn->prepare('INSERT INTO salas (ahorro_id, codigo, creado_por) VALUES (:ahorro_id, :codigo, :creado_por)');
    $stmt2->bindParam(':ahorro_id', $ahorro_id, PDO::PARAM_INT);
    $stmt2->bindParam(':codigo', $codigo_sala, PDO::PARAM_STR);
    $stmt2->bindParam(':creado_por', $user_id, PDO::PARAM_INT);

    if (!$stmt2->execute()) {
        throw new Exception("Error al crear la sala");
    }

    $sala_id = $conn->lastInsertId();

    // Insertar el creador de la sala como miembro de la sala
    $stmt3 = $conn->prepare('INSERT INTO sala_miembros (sala_id, usuario_id) VALUES (:sala_id, :usuario_id)');
    $stmt3->bindParam(':sala_id', $sala_id, PDO::PARAM_INT);
    $stmt3->bindParam(':usuario_id', $user_id, PDO::PARAM_INT);

    if (!$stmt3->execute()) {
        throw new Exception("Error al agregar al usuario a la sala");
    }

    // Confirmar la transacción
    $conn->commit();

    echo json_encode(["status" => "success", "message" => "Ahorro y sala creados exitosamente. Código de sala: $codigo_sala"]);

} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode(["status" => "error", "message" => "Error en la conexión: " . $e->getMessage()]);
} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}