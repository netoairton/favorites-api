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
    $products_return = [];
    foreach ($productIds as $id) {
        $product = return_product($id);
        if ($product) {
            $final_product['id'] = $product['id'];
            $final_product['title'] = $product['title'];
            $final_product['image'] = $product['image'];
            $final_product['price'] = $product['price'];
            $final_product['rating'] = isset($product['rating']) ? $product['rating'] : [];

            $products_return[] = $final_product;
        }
    }
    return $products_return;
}

?>