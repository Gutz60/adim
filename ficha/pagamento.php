<?php
session_start();
include('db.php');

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['data_consulta'])) {
    header("Location: confirmacao.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$data_consulta = $_SESSION['data_consulta'];
$hora_consulta = $_SESSION['hora_consulta'];
$descricao = $_SESSION['descricao'];
$plano = $_SESSION['plano'];

$mensagem_sucesso = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $forma_pagamento = $_POST['forma_pagamento'];
    
    $sql_consulta = "INSERT INTO consultas (usuario_id, data_consulta, hora_consulta, descricao) 
                     VALUES ('$usuario_id', '$data_consulta', '$hora_consulta', '$descricao')";
    if ($conn->query($sql_consulta) === TRUE) {
        $consulta_id = $conn->insert_id;

        $sql_pagamento = "INSERT INTO pagamentos (usuario_id, plano, forma_pagamento, status_pagamento, consulta_id) 
                          VALUES ('$usuario_id', '$plano', '$forma_pagamento', 'Aguardando confirmação presencial', '$consulta_id')";

        if ($conn->query($sql_pagamento) === TRUE) {
            $mensagem_sucesso = "Seu pagamento será realizado no momento da sua chegada à academia. Obrigado!";
        } else {
            $mensagem_sucesso = "Erro ao registrar pagamento: " . $conn->error;
        }
    } else {
        $mensagem_sucesso = "Erro ao agendar consulta: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagamento</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Escolha a Forma de Pagamento</h1>

    <?php if (!empty($mensagem_sucesso)) : ?>
        <p class="mensagem-sucesso"><?= $mensagem_sucesso ?></p>
    <?php else : ?>
        <form method="post" action="">
            <label for="forma_pagamento">Forma de Pagamento:</label>
            <select id="forma_pagamento" name="forma_pagamento" required>
                <option value="Cartão de Crédito">Cartão de Crédito</option>
                <option value="Pix">Pix</option>
                <option value="Boleto">Boleto Bancário</option>
            </select>
            <button type="submit">Confirmar Forma Pagamento</button>
        </form>
    <?php endif; ?>
</body>
</html>
