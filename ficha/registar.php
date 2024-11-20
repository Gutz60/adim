<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "adm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$nome = $_POST['nome_completo'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar_senha = $_POST['confirmar_senha'];

if ($senha !== $confirmar_senha) {
    echo "
    <html>
    <head>
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #0f0c25;
                color: white;
            }
            .mensagem {
                background-color: #7f00b2;
                color: #fff;
                padding: 20px;
                border-radius: 10px;
                font-size: 18px;
                text-align: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            }
        </style>
    </head>
    <body>
        <div class='mensagem'>
            <p>As senhas não coincidem. Tente novamente!</p>
        </div>

         <script>
            setTimeout(function() {
                window.location.href = 'crc.html';
            }, 3000);
        </script>


    </body>
    </html>
    ";
    exit();
}

$sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql_check_email);

if ($result->num_rows > 0) {
    echo "
    <html>
    <head>
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #0f0c25;
                color: white;
            }
            .mensagem {
                background-color: #ab3ed8;
                color: #fff;
                padding: 20px;
                border-radius: 10px;
                font-size: 18px;
                text-align: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            }
        </style>
    </head>
    <body>
        <div class='mensagem'>
            <p>O e-mail já está cadastrado. Por favor, faça login!</p>
        </div>

         <script>
            setTimeout(function() {
                window.location.href = 'login.html';
            }, 3000);
        </script>



    </body>
    </html>
    ";
    exit();
}

$senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome_completo, email, senha) VALUES ('$nome', '$email', '$senha_hashed')";

if ($conn->query($sql) === TRUE) {
    echo "
    <html>
    <head>
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #0f0c25;
                color: white;
            }
            .mensagem {
                background-color: #2196f3;
                color: #fff;
                padding: 20px;
                border-radius: 10px;
                font-size: 18px;
                text-align: center;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
        </style>
    </head>
    <body>
        <div class='mensagem'>
            <p>Conta criada com sucesso! Redirecionando...</p>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = 'index.html';
            }, 3000);
        </script>
    </body>
    </html>
    ";
} else {
    echo "Erro ao criar a conta: " . $conn->error;
}

$conn->close();
?>
