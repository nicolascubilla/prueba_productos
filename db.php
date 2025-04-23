<?php
$host = "localhost";
$dbname = "lp3";
$user = "postgres";
$password = "123";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al conectar a la base de datos"]);
    exit;
}
?>
