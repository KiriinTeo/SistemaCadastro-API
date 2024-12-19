<?php
header("Content-Type: application/json");
include_once("db.php");

$pdo = conexao_db();

try {
    $sql = "SELECT id, email, senha FROM usuario ORDER BY id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'data' => $usuarios
    ], JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Erro ao buscar dados: ' . $e->getMessage()
    ]);
}
?>
