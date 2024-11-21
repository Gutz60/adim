<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Verifica se a sessão tem os dados da consulta
if (isset($_SESSION['data_consulta']) && isset($_SESSION['hora_consulta'])) {
    $data_consulta = $_SESSION['data_consulta'];
    $hora_consulta = $_SESSION['hora_consulta'];

    // Limpa os dados de consulta da sessão após a confirmação
    unset($_SESSION['data_consulta']);
    unset($_SESSION['hora_consulta']);
} else {
    // Se não houver dados, redireciona para a página de agendamento
    header("Location: marcar_consulta.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Agendamento</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Consulta Agendada com Sucesso!</h2>
        <div class="confirmation-box">
            <p><strong>Data da Consulta:</strong> <?php echo date("d/m/Y", strtotime($data_consulta)); ?></p>
            <p><strong>Hora da Consulta:</strong> <?php echo date("H:i", strtotime($hora_consulta)); ?></p>
            <p>Obrigado por agendar sua consulta! Se precisar alterar ou cancelar, entre em contato conosco.</p>
        </div>
        <a href="marcar_consulta.php" class="button">Voltar para o Agendamento</a>
    </div>
</body>
</html>
