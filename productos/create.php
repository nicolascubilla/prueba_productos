<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

include '../db.php';

// Obtener el contenido JSON enviado
$data = json_decode(file_get_contents("php://input"), true);

// Validar campos requeridos
if (
    !isset($data['nombre']) || empty($data['nombre']) ||
    !isset($data['precio']) || !is_numeric($data['precio']) ||
    !isset($data['stock']) || !is_numeric($data['stock'])
) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan campos requeridos o datos inválidos"]);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, stock) VALUES (:nombre, :precio, :stock)");
    $stmt->execute([
        ":nombre" => $data['nombre'],
        ":precio" => $data['precio'],
        ":stock" => $data['stock']
    ]);

    http_response_code(201); // Created
    echo json_encode(["mensaje" => "Producto creado exitosamente"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al insertar producto"]);
}
