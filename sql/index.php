<?php
//Testando conexão ao banco
require_once "config.php";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);

    // Consultando a tabela de client
    $sql = "SELECT * FROM client";
    $stmt = $pdo->query($sql);
    if (!$stmt) {
        die("Erro na consulta");
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo 'id: ' .$row['id'].'<br>'.
        'Nome: ' .$row['name'].'<br>'.
        'Email: ' .$row['email'].'<br><hr>';
    }

} catch (PDOException $e) {
    echo "O seguinte erro foi identificado na conexão: " . $e->getMessage();
}
?>