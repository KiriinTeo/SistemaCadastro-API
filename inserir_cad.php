<?php
$url = "http://localhost/api_login/cadNovo.php"; // URL da API

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    echo "Erro: Campos obrigatórios não preenchidos!";
    exit;
}

$data = [
    'email' => $email,
    'senha' => $senha
];

//extract($data);

// Inicializa o cURL
$ch = curl_init($url);

// Configura as opções do cURL
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

$response = curl_exec($ch);

// Verifica erros na requisição
if (curl_errno($ch)) {
    echo "Erro na requisição: " . curl_error($ch);
    curl_close($ch);
    exit;
}

// Fecha o cURL
curl_close($ch);

// Decodifica a resposta JSON
$result = json_decode($response, true);

// Exibe o resultado da API
if ($result === null) {
    echo "Erro: resposta inválida da API.";
    exit;
}

echo "Resposta: " . htmlspecialchars($result['message']);
?>
