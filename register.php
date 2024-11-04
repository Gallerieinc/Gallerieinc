<?php
// Definindo as informações de conexão ao banco de dados
$servername = "localhost"; // ou seu host do banco de dados

$dbname = "db_gallerie";

// Criando a conexão
$conn = new mysqli($servername, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Coletando os dados do formulário
$nome = $_POST['name'];
$email = $_POST['email'];
$senha = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash da senha

// Preparando e vinculando
$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senha);

// Executando
if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

// Fechando a conexão
$stmt->close();
$conn->close();
?>
