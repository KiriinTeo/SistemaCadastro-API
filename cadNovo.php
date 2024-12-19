<?php
/*
include_once("db.php");

$conexao = conexao_db();

$sql = "INSERT INTO usuario (email, senha)
        VALUES (:email, :senha)";

$comando = $conexao->prepare($sql)

$comando->bindParam(':email', $email);
$comando->bindParam(':senha', $senha);
*/
?>

<?php
header("Content-Type: application/json");

include_once("db.php");

$pdo = conexao_db();

// Verifica se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Método não permitido']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null) {
    http_response_code(400);
    echo json_encode(['message' => 'Entrada inválida. Certifique-se de enviar JSON válido.']);
    exit;
}

$email = $data['email'] ?? '';
$senha = $data['senha'] ?? '';

// Valida os campos obrigatórios
if (empty($email) || empty($senha)) {
    http_response_code(400);
    echo json_encode(['message' => 'Campos obrigatórios:email e senha']);
    exit;
}

$senha_hash = hash('sha256', $senha);

try {

    $stmt = $pdo->prepare("INSERT INTO usuario (email, senha) VALUES (:email, :senha)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha_hash);

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(['message' => 'Usuário cadastrado com sucesso']);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Falha ao cadastrar usuário']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Erro no servidor: ' . $e->getMessage()]);
}
?>
