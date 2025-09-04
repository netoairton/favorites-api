<?php
require_once __DIR__ . '/../sql/connect.php';

$sql = "SELECT * FROM client";
$stmt = $pdo->query($sql);
if (!$stmt) {
    http_response_code(400);
    echo json_encode(["error" => "Consult error"]);
    die();
} else {
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(["data" => $clients]);
}

?>