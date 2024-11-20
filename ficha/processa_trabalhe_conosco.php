<?php
// Conectar ao banco de dados
$servername = "localhost";  // Substitua com seu servidor de banco de dados
$username = "root";         // Seu nome de usuário do banco de dados
$password = "";             // Sua senha do banco de dados
$dbname = "adm";            // Nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obter os dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $jobPosition = $_POST['jobPosition'];
    $otherJob = isset($_POST['otherJob']) ? $_POST['otherJob'] : NULL;
    $experience = $_POST['experience'];
    $availability = $_POST['availability'];

    // Processar o upload do arquivo
    if (isset($_FILES['curriculum']) && $_FILES['curriculum']['error'] === UPLOAD_ERR_OK) {
        $curriculum = $_FILES['curriculum'];

        // Verificar se o arquivo foi enviado corretamente
        $uploadDir = "uploads/";
        $uploadFile = $uploadDir . basename($curriculum['name']);
        
        // Verificar tipo do arquivo
        $allowedTypes = ['pdf', 'doc', 'docx'];
        $fileExtension = pathinfo($curriculum['name'], PATHINFO_EXTENSION);

        if (in_array(strtolower($fileExtension), $allowedTypes)) {
            // Mover o arquivo para o diretório de upload
            if (move_uploaded_file($curriculum['tmp_name'], $uploadFile)) {
                // Preparar o SQL para inserção
                $stmt = $conn->prepare("INSERT INTO trabalho_conosco (name, email, phone, jobPosition, otherJob, experience, availability, curriculum) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $name, $email, $phone, $jobPosition, $otherJob, $experience, $availability, $uploadFile);

                // Executar a consulta
                if ($stmt->execute()) {
                    echo "Dados enviados com sucesso!";
                } else {
                    echo "Erro ao enviar os dados: " . $stmt->error;
                }
                
                // Fechar a declaração
                $stmt->close();
            } else {
                echo "Erro ao mover o arquivo.";
            }
        } else {
            echo "Tipo de arquivo inválido. Envie um arquivo PDF ou DOC.";
        }
    } else {
        echo "Erro ao enviar o currículo.";
    }
}

// Fechar a conexão
$conn->close();
?>
