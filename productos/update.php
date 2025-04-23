<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");

include '../db.php';

// Obtener y decodificar el JSON recibido
$data = json_decode(file_get_contents("php://input"), true);

// Validar campos requeridos
if (
    !isset($data['id']) || !is_numeric($data['id']) ||
    !isset($data['nombre']) || empty($data['nombre']) ||
    !isset($data['precio']) || !is_numeric($data['precio']) ||
    !isset($data['stock']) || !is_numeric($data['stock'])
) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan campos requeridos o datos inválidos"]);
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

    // Actualizar el producto
    $stmt = $pdo->prepare("UPDATE productos SET nombre = :nombre, precio = :precio, stock = :stock WHERE id = :id");
    $stmt->execute([
        ':id' => $data['id'],
        ':nombre' => $data['nombre'],
        ':precio' => $data['precio'],
        ':stock' => $data['stock']
    ]);

    echo json_encode(["mensaje" => "Producto actualizado correctamente"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al actualizar producto"]);
}
