<?php
require_once __DIR__ . '/../sql/connect.php';


if (!isset($inputPUT['email']) && !isset($inputPUT['name'])) {
    http_response_code(400);
    echo json_encode(["error" => "Required data for client update not provided."]);
    exit;
}else {
    require_once "validation.php";

    if(isset($inputPUT['email'])){
        validate_email($inputPUT['email']);
    }
    if(isset($inputPUT['name'])){
        validate_name($inputPUT['name']);
    }

    $email = isset($inputPUT['email']) ? trim($inputPUT['email']) : null;
    $name = isset($inputPUT['name']) ? trim($inputPUT['name']) : null;

    if ($name || $email) { 
        $stmt = $pdo->prepare("SELECT id FROM client WHERE id = ?");
        $stmt->execute([$id]);
        $client = $stmt->fetch();

        if (!$client) {
            http_response_code(404);
            echo json_encode(["error" => "Client not found"]);
            exit;
        }

        if ($email && $name) {
            try {
                $stmt = $pdo->prepare("UPDATE client SET name = ?, email = ? WHERE id = ?");
                $stmt->execute([$name, $email, $id]);
                echo json_encode(["message" => "Success on client update"]);
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
        } elseif ($email) {
            try {
                $stmt = $pdo->prepare("UPDATE client SET email = ? WHERE id = ?");
                $stmt->execute([$email, $id]);
                echo json_encode(["message" => "Success on client update"]);
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
        } elseif ($name) {
            $stmt = $pdo->prepare("UPDATE client SET name = ? WHERE id = ?");
            $stmt->execute([$name, $id]);
            echo json_encode(["message" => "Success on client update"]);
            exit;
        }

    } else {
        http_response_code(400);
        echo json_encode(["error" => "Required data for client update not provided."]);
        exit;
    }
}

?>