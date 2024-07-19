<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
    exit();
}

require'./../../controller/bd.php';

$ahorro_id = $_POST['id'] ?? null;

if (!$ahorro_id) {
    echo json_encode(["status" => "error", "message" => "ID de ahorro no proporcionado"]);
    exit();
}

try {
    // Iniciar una transacción
    $conn->beginTransaction();

    // Eliminar los registros relacionados en la tabla `salas`
    $stmt = $conn->prepare('DELETE FROM salas WHERE ahorro_id = :ahorro_id');
    $stmt->bindParam(':ahorro_id', $ahorro_id, PDO::PARAM_INT);
    $stmt->execute();

    // Eliminar los registros relacionados en la tabla `ingresos`
    $stmt2 = $conn->prepare('DELETE FROM ingresos WHERE ahorro_id = :ahorro_id');
    $stmt2->bindParam(':ahorro_id', $ahorro_id, PDO::PARAM_INT);
    $stmt2->execute();

    // Eliminar el registro en la tabla `ahorros`
    $stmt3 = $conn->prepare('DELETE FROM ahorros WHERE id = :id');
    $stmt3->bindParam(':id', $ahorro_id, PDO::PARAM_INT);
    $stmt3->execute();

    // Confirmar la transacción
    $conn->commit();

    echo json_encode(["status" => "success", "message" => "Ahorro y registros relacionados eliminados exitosamente"]);

} catch (PDOException $e) {
    // Revertir la transacción en caso de error
    $conn->rollBack();
    echo json_encode(["status" => "error", "message" => "Error en la conexión: " . $e->getMessage()]);
} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}