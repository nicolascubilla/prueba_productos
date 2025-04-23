<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");

include '../db.php';

// Obtener el contenido del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

// Validar que se envió un ID válido
if (!isset($data['id']) || !is_numeric($data['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "ID inválido o no proporcionado"]);
    exit;
}

try {
    // Verificar si el producto existe
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
    $stmt->execute([':id' => $data['id']]);
    $producto = $stmt->fetch();

    if (!$producto) {
        http_response_code(404);
        echo json_encode(["error" => "Producto no encontrado"]);
        exit;
    }

    // Eliminar el producto
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = :id");
    $stmt->execute([':id' => $data['id']]);

    echo json_encode(["mensaje" => "Producto eliminado correctamente"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al eliminar producto"]);
}
