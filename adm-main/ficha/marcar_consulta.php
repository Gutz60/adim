<?php
session_start();
include('db.php'); // Inclui a conexão com o banco de dados

$erro_horario = "";

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Processa o formulário se ele for enviado com método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_consulta = $_POST['data_consulta'];
    $hora_consulta = $_POST['hora_consulta'];

    // Verifica se a data e a hora já estão ocupadas
    $sql_verifica = "SELECT * FROM consultas WHERE data_consulta = '$data_consulta' AND hora_consulta = '$hora_consulta'";
    $result = $conn->query($sql_verifica);

    if ($result->num_rows > 0) {
        echo "Data ou hora indisponível. Por favor, escolha outro horário.";
    } else {
        // Insere o agendamento no banco de dados
        $sql = "INSERT INTO consultas (usuario_id, data_consulta, hora_consulta) VALUES ('$usuario_id', '$data_consulta', '$hora_consulta')";

        if ($conn->query($sql) === TRUE) {
            // Salva os dados da consulta na sessão para exibição na página de confirmação
            $_SESSION['data_consulta'] = $data_consulta;
            $_SESSION['hora_consulta'] = $hora_consulta;

            // Redireciona para a página de confirmação
            header("Location: confirmacao.php");
            exit;
        } else {
            echo "Erro ao marcar a consulta: " . $conn->error;
        }
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agendar Consulta</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Agendar Consulta com Nutricionista</h2>
    
    <?php if ($erro_horario): ?>
        <div class="erro-horario">
            <p><?php echo $erro_horario; ?></p>
            <p>Horários disponíveis para <?php echo $data_consulta; ?>:</p>
            <ul>
                <?php foreach ($horarios_disponiveis as $horario): ?>
                    <li><?php echo $horario; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="data_consulta">Data:</label>
        <input type="date" id="data_consulta" name="data_consulta" required>
        
        <label for="hora_consulta">Hora:</label>
        <input type="time" id="hora_consulta" name="hora_consulta" required>
        
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea>
        
        <button type="submit">Agendar Consulta</button>
    </form>
</body>
</html>
