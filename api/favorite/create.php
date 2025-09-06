<?php
require_once __DIR__ . '/../sql/connect.php';

if (isset($inputPOST['clientId']) && isset($inputPOST['productId'])) {
    $clientId = $inputPOST['clientId'];
    $productId = $inputPOST['productId'];

    require_once "validation.php";
    validate_clientId($clientId);
    validate_productId($productId);

    require_once "product.php";
    product_exists($productId);

    try {
        $stmt = $pdo->prepare("INSERT INTO favoriteProduct (productId, clientId) VALUES (?, ?)");
        $stmt->execute([$productId, $clientId]);
        http_response_code(201);
        echo json_encode(["message" => "Success on favorite product creation"]);
        exit;
    } catch (PDOException $error) {
        if ($error->getCode() == 23505) {
            http_response_code(400);
            echo json_encode(["error" => "Product already favorited by client"]);
            exit;
        } else if ($error->getCode() == 23503) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid Client id"]);
            exit;
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Undisclosed internal error"]);
            exit;
        }
    }

} else {
    http_response_code(400);
    echo json_encode(["error" => "Required data for favorite creation not provided."]);
    exit;
}

?>