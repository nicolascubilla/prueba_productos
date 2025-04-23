<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../db.php';

// Obtener el ID del producto desde la URL
$id = isset($_GET['id']) ? $_GET['id'] : die();

// Consultar producto por ID
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id LIMIT 1");
$stmt->bindParam(":id", $id);
$stmt->execute();

// Verificar si el producto existe
if ($stmt->rowCount() > 0) {
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($producto);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Producto no encontrado"]);
}
