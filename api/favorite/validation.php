<?php

function validate_productId($productId){
    if (empty($productId) ){
        http_response_code(400);
        echo json_encode(["error" => "Product id value cannot be empty"]);
        exit;
    } else if ( !is_numeric($productId) || intval($productId) <= 0 ){
        http_response_code(400);
        echo json_encode(["error" => "Invalid format for product id"]);
        exit;
    }
}

function validate_clientId($clientId){
    if ( empty($clientId) ){
        http_response_code(400);
        echo json_encode(["error" => "Client id value cannot be empty"]);
        exit;
    } else if ( !is_numeric($clientId) || intval($clientId) <= 0 ){
        http_response_code(400);
        echo json_encode(["error" => "Invalid format for client id"]);
        exit;
    }
}

?>