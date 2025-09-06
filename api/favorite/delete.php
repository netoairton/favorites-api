<?php
require_once __DIR__ . '/../sql/connect.php';

$clientId = $_GET['clientId'];
$productId = $_GET['productId'];

require_once "validation.php";
validate_clientId($clientId);
validate_productId($productId);

$stmt = $pdo->prepare("SELECT id FROM favoriteProduct WHERE productId = ? AND clientId = ?");
$stmt->execute([$productId, $clientId]);

$favoriteProduct = $stmt->fetch();

if (!$favoriteProduct) {
    http_response_code(404);
    echo json_encode(["error" => "Favorite product not found"]);
    exit;

} else {
    $stmt = $pdo->prepare("DELETE FROM favoriteProduct WHERE productId = ? AND clientId = ?");
    $stmt->execute([$productId, $clientId]);
    echo json_encode(["message" => "Success on unfavoriting product"]);
    
}

?>