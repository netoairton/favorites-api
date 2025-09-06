<?php

header('Content-type: application/json; charset=utf-8');
if ( isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="POST" ) {
    $inputPOST = json_decode(file_get_contents("php://input"), true);
    if ( isset($inputPOST["username"]) && isset($inputPOST["password"]) ) {
        $username = $inputPOST['username'];
        $password = $inputPOST['password'];

        $systemUser = 'admin';
        $systemPassword = 'password123';

        if ($username !== $systemUser || $password !== $systemPassword) {
            http_response_code(401);
            echo json_encode(['error' => 'Wrong credentials provided.']);
            exit;
        }else{
            $secret_hash = "PROJETO_AIQFOME_2025";
            $payload = base64_encode(json_encode(['username' => $username, 'exp' => time() + 3600 //1 hour
            ]));
            $signatur = base64_encode( hash_hmac('sha256', $payload, $secret_hash, true) );
            $token = $payload.".".$signatur;
            echo json_encode(['access_token' => $token]);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Required data for authentication not provided."]);
        exit;
    }

} else {
    http_response_code(405);
    echo json_encode(["error" => "Unsupported method."]);
}
?>