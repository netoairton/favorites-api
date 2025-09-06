<?php

$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';

$token = str_replace('Bearer ', '', $authHeader);

if( isset($token) ){
    $secret_hash = "PROJETO_AIQFOME_2025";
    $tokenParts = explode('.', $token);
    if (count($tokenParts) !== 2) {
        header('Content-type: application/json; charset=utf-8');
        http_response_code(401);
        echo json_encode(["error" => "Invalid access token format."]);
        exit;
    }

    $payload = $tokenParts[0];
    $signatur_provided = $tokenParts[1];

    $payloadData = json_decode(base64_decode($payload), true);
    $signatur = base64_encode( hash_hmac('sha256', $payload, $secret_hash, true) );

    if ($signatur !== $signatur_provided) {
        header('Content-type: application/json; charset=utf-8');
        http_response_code(401);
        echo json_encode(["error" => "Invalid access token."]);
        exit;

    }

    if ($payloadData['exp'] < time()) {
        header('Content-type: application/json; charset=utf-8');
        http_response_code(401);
        echo json_encode(["error" => "Expired access token provided."]);
        exit;

    }
    
} else{
    header('Content-type: application/json; charset=utf-8');
    http_response_code(401);
    echo json_encode(["error" => "Access token not provided."]);
    exit;
}

?>