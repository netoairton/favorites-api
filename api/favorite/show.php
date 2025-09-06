<?php
require_once __DIR__ . '/../sql/connect.php';

$stmt = $pdo->prepare("SELECT productId FROM favoriteProduct WHERE clientId = ? ORDER BY productId");
$stmt->execute([$id]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$productIds = array_column($products, 'productid');

require_once "product.php";

echo json_encode( ["data" => return_products($productIds)] );

?>