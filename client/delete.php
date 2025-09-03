<?php
require_once "../sql/connect.php";

$stmt = $pdo->prepare("SELECT id FROM client WHERE id = ?");
$stmt->execute([$id]);

$client = $stmt->fetch();

if (!$client) {
    http_response_code(404);
    echo json_encode(["error" => "Client not found"]);
    exit;

} else {
    $stmt = $pdo->prepare("DELETE FROM client WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(["message" => "Success on client delete"]);
    
}

?>