<?php
require_once "../sql/connect.php";


if (isset($inputPOST['email']) && isset($inputPOST['name'])) {
    $email = trim($inputPOST['email']);
    $name = trim($inputPOST['name']);

    require_once "validation.php";
    validate_email($email);
    validate_name($name);

    try {
        $stmt = $pdo->prepare("INSERT INTO client (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);
        http_response_code(201);
        echo json_encode(["message" => "Success on client creation"]);
        exit;
    } catch (PDOException $error) {
        if ($error->getCode() == 23505) { //Code for UNIQUE postgresql violation
            http_response_code(400);
            echo json_encode(["error" => "Client email already exists in database"]);
            exit;
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Undisclosed internal error"]);
            exit;
        }
    }

} else {
    http_response_code(400);
    echo json_encode(["error" => "Required data for client creation not provided."]);
    exit;
}

?>