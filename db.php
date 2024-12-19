<?php

function conexao_db() {
    
    // Configurações do banco de dados
    $host = 'localhost';
    $dbname = 'apiLogin';
    $username = 'postgres'; 
    $password = 'honda';     

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }

    return $pdo; // Retorna a conexão com o banco
}
?>
