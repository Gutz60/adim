<?php
session_start();
$servername = "localhost";
$username = "root"; // Seu usuário do banco de dados
$password = ""; // Sua senha do banco de dados
$dbname = "adm"; // Nome do banco de dados

// Conecte-se ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o POST está sendo recebido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Busca o usuário no banco de dados
    $sql = "SELECT id, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifica a senha
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        header("Location: exibir_treino.php"); // Redireciona para a página principal
        exit;
    } else {
        echo "Credenciais incorretas.";
    }
}

$conn->close();
?>
