<?php
$host = 'localhost'; // ou o endereço do seu servidor
$dbname = 'agendaDigitial';
$username = 'root'; // seu usuário do MySQL
$password = ''; // sua senha do MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>