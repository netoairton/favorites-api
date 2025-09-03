<?php

function validate_email($email){
    if (empty($email) ){
        http_response_code(400);
        echo json_encode(["error" => "Client email value cannot be empty"]);
        exit;
    } else if ( strlen($email) >= 300 ){
        http_response_code(400);
        echo json_encode(["error" => "Client email value too large"]);
        exit;
    } else if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
        http_response_code(400);
        echo json_encode(["error" => "Client email value has invalid format"]);
        exit;
    }
}

function validate_name($name){
    if ( empty($name) ){
        http_response_code(400);
        echo json_encode(["error" => "Client name value cannot be empty"]);
        exit;
    } else if ( strlen($name) >= 1000 ){
        http_response_code(400);
        echo json_encode(["error" => "Client name value too large"]);
        exit;
    }
}

?>