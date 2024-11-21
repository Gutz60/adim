<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $sql = "SELECT id, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $senha === $user['senha']) {
        $_SESSION['usuario_id'] = $user['id'];
        header("Location: ../index.html");
        exit;
    } else {
        echo "Credenciais incorretas.";
    }
}

$conn->close();
?>
