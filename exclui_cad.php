<?php
$url = "http://localhost/api_login/excluirApi.php"; // URL da API

$email = $_POST['email'] ?? '';

if (empty($email)) {
    echo "Erro: Campos obrigatórios não preenchidos!";
    exit;
}

$data = [
    'email' => $email,
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

curl_close($ch);

$result = json_decode($response, true);

if ($result === null) {
    echo "Erro: Resposta inválida da API.";
    exit;
}

// Exibe o resultado da API
if (isset($result['message'])) {
    echo "Resposta: " . htmlspecialchars($result['message']);
} else {
    echo "Erro: Resposta inesperada da API.";
}
?>
