<?php

function product_exists($productId){
    $response = file_get_contents('https://fakestoreapi.com/products/' . $productId);
    $productData = json_decode($response, true);
    if (!$productData) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid product id"]);
        exit;
    }
}

function return_product($productId){
    $response = file_get_contents('https://fakestoreapi.com/products/' . $productId);
    $productData = json_decode($response, true);
    if ( !empty($productData) ) {
        return $productData;
    } else {
        return null;
    }
}

function return_products($productIds){
    $products = [];
    foreach ($productIds as $id) {
        $product = return_product($id);
        if ($product) {
            $products[] = $product;
        }
    }
    return $products;
}

?>