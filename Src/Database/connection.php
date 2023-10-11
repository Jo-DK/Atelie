<?php

// Definindo as informações de conexão
$host = "127.0.1.1";
$username = "root";
$password = "1234";
$database = "Atelie";

// Conectando ao banco de dados
$conn = new mysqli($host, $username, $password, $database);

$banco = new PDO("mysql:host=$host;dbname=$database", $username,$password);

// Verificando se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $conn->connect_error);
}

$result = $conn->query( "select * from Atelie.Participantes");
var_dump($result);
// Imprimindo um mensagem de sucesso
echo "Conexão ao banco de dados bem-sucedida!";

// Fechando a conexão
mysqli_close($conn);

?>


