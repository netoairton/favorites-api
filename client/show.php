<?php
require_once "../sql/connect.php";

$stmt = $pdo->prepare("SELECT * FROM client WHERE id = ?");
$stmt->execute([$id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if ($client) {
    echo json_encode($client);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Client not found"]);
}

?>