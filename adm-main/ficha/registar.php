<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "adm";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$nome = $_POST['nome_completo'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar_senha = $_POST['confirmar_senha'];

if ($senha !== $confirmar_senha) {
    echo "As senhas não coincidem.";
    exit();
}

$senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

// Inserir dados no banco de dados
$sql = "INSERT INTO usuarios (nome_completo, email, senha) VALUES ('$nome', '$email', '$senha_hashed')";

if ($conn->query($sql) === TRUE) {
    // Mensagem de sucesso
    echo "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #f0f0f0;
            }
            .mensagem {
                background-color: #327dbf;
                color: white;
                padding: 20px;
                border-radius: 10px;
                font-size: 18px;
                text-align: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
        </style>
    </head>
    <body>
        <div class='mensagem'>
            <p>Conta criada com sucesso!</p>
        </div>
        <script>
           
            setTimeout(function() {
                window.location.href = 'index.html';
            }, 3000); // 3000 milissegundos = 3 segundos
        </script>
    </body>
    </html>
    ";
} else {
    echo "Erro ao criar a conta: " . $conn->error;
}

$conn->close();
?>
