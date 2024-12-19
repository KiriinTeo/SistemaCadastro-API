<?php
header("Content-Type: application/json");

// Inclui a conexão com o banco
include_once("db.php");

$pdo = conexao_db();

$data = json_decode(file_get_contents("php://input"), true);

// Verifica o método da requisição
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Método não permitido']);
    exit;
}

// Valida os campos enviados
$email = $data['email'] ?? '';

if (empty($email)) {
    http_response_code(400);
    echo json_encode(['message' => 'Email é obrigatório']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM usuario WHERE email = :email");
    $stmt->bindParam(':email', $email);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        echo json_encode([
            'message' => 'Cadastro excluído com sucesso',
            'email' => $email
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Usuário não encontrado']);
    }
    

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Erro no servidor: ' . $e->getMessage()]);
}
?>
