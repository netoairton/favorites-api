<?php
header('Content-type: application/json; charset=utf-8');

require_once __DIR__ . '/../auth/validate.php';

$methodList = ["GET", "POST", "DELETE"]; //lista de métodos aceitos
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
            http_response_code(400);
            echo json_encode(["error" => "Required clientId for GET method not provided."]);
            exit;
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
            echo json_encode(["error" => "Required data for favorite creation not provided."]);
            exit;
        }
    }


} else {
    http_response_code(405);
    echo json_encode(["error" => "Unsupported method."]);
}
?>