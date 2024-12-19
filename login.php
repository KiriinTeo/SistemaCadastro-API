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
$senha = $data['senha'] ?? '';

if (empty($email) || empty($senha)) {
    http_response_code(400);
    echo json_encode(['message' => 'Email e senha são obrigatórios']);
    exit;
}

try {
    // Prepara a consulta para buscar o usuário no banco
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário foi encontrado e se a senha é válida
    if ($user && hash('sha256', $senha) === $user['senha']) {
        
        $token = bin2hex(random_bytes(16));

        echo json_encode([
            'message' => 'Login bem-sucedido',
            'email' => $user['email'], 
            'senha_hash' => $user['senha'], 
            'token' => $token
        ]);
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Credenciais inválidas']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Erro no servidor: ' . $e->getMessage()]);
}
?>
