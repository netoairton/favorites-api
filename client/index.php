<?php
header('Content-type: application/json; charset=utf-8');

$methodList = ["GET", "POST", "PUT", "DELETE"]; //lista de métodos aceitos
if ( isset($_SERVER["REQUEST_METHOD"]) && in_array($_SERVER["REQUEST_METHOD"], $methodList) ) {
    $method = $_SERVER['REQUEST_METHOD'];
    $url = $_SERVER["REQUEST_URI"];
    $idTemp = explode(basename(__DIR__)."/", $url); //Na url, separo a string que estiver após o diretório atual para pegar o id
    $haveId = FALSE;
    
    if ( isset($idTemp[1]) && is_numeric($idTemp[1]) ){
        $haveId = TRUE;
        $id = str_replace("/", "", $idTemp[1]);
        $id = (int) $id;
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid ID"]);
            exit;
        }
    }

    if ($method == "GET") {
        if ($haveId){
            require_once "show.php";
        } else {
            require_once "list.php";
        }

    } else if ($method == "DELETE") {
        if ($haveId){
            require_once "delete.php";
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Required id for DELETE method not provided."]);
            exit;
        }

    } else if ($method == "POST") {
        $inputPOST = json_decode(file_get_contents("php://input"), true);
        if ( isset($inputPOST) ) {
            require_once "create.php";
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Required data for client creation not provided."]);
            exit;
        }
    } else if ($method == "PUT") {
        $inputPUT = json_decode(file_get_contents("php://input"), true);
        if ( isset($inputPUT) && $haveId ) {
            require_once "update.php";
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Required data for client update not provided."]);
            exit;
        }
    }


} else {
    http_response_code(405);
    echo json_encode(["error" => "Unsupported method."]);
}

?>