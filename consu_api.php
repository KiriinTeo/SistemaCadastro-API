<?php
$url = "http://localhost/api_login/login.php"; // URL da API

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
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Exibe a resposta bruta e o código HTTP para diagnóstico
echo "Resposta bruta da API: " . $response . "\n" . "<br>" . "<br>";
echo "Código HTTP: " . $http_code . "\n";

$result = json_decode($response, true);

if ($result === null) {
    echo "Erro ao decodificar JSON: " . json_last_error_msg() . "\n";
    exit;
}

// Exibe o resultado da API
if (isset($result['token'])) {
    /*echo "Login bem-sucedido! Token: " . $result['token'] . "<br>";
    echo "E-mail: " . htmlspecialchars($result['email']) . "<br>"; // Evita XSS
    echo "Senha (hash): " . htmlspecialchars($result['senha_hash']) . "<br>";
    */
    header('Location: principal_bd.php?email=' . urlencode($email));
    exit;
} else {
    echo "Erro: " . ($result['message'] ?? 'Resposta inesperada da API.');
}
?>
