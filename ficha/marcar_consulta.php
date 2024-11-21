<?php
session_start();
include('db.php'); 

$erro_horario = "";
$erro_login = "";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$plano_selecionado = isset($_GET['plano']) ? $_GET['plano'] : "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_consulta = $_POST['data_consulta'];
    $hora_consulta = $_POST['hora_consulta'];
    $descricao = $_POST['descricao'];
    $plano = $_POST['plano'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validação do horário
    $hora_minima = "08:00";
    $hora_maxima = "20:00";
    if ($hora_consulta < $hora_minima || $hora_consulta > $hora_maxima) {
        $erro_horario = "Horário inválido. As consultas devem ser marcadas entre 08:00 e 20:00.";
    } else {
        $sql_usuario = "SELECT * FROM usuarios WHERE id = '$usuario_id' AND email = '$email' AND senha = '$senha'";
        $result_usuario = $conn->query($sql_usuario);

        if ($result_usuario->num_rows === 0) {
            $erro_login = "Email ou senha incorretos.";
        } else {
            $sql_verifica = "SELECT * FROM consultas WHERE data_consulta = '$data_consulta' AND hora_consulta = '$hora_consulta'";
            $result = $conn->query($sql_verifica);

            if ($result->num_rows > 0) {
                $erro_horario = "Data ou hora indisponível. Escolha outro horário.";
            } else {
                // Inserir a consulta na tabela conectada ao usuário
                $sql_insert = "INSERT INTO consultas (usuario_id, data_consulta, hora_consulta, descricao, plano) 
                               VALUES ('$usuario_id', '$data_consulta', '$hora_consulta', '$descricao', '$plano')";
                if ($conn->query($sql_insert) === TRUE) {
    $_SESSION['data_consulta'] = $data_consulta;
    $_SESSION['hora_consulta'] = $hora_consulta;
    $_SESSION['descricao'] = $descricao;
    $_SESSION['plano'] = $plano;
    header("Location: pagamento.php");
    exit;
}

                if ($conn->query($sql_insert) === TRUE) {
                    // Redireciona para a página pagamentos.php
                    header("Location: pagamentos.php");
                    exit;
                } else {
                    echo "Erro ao agendar a consulta: " . $conn->error;
                }
            }
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Agendar Consulta com Nutricionista</h1>
    <a class="btn-voltar" href="../paginas/planos.html">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>Voltar
    </a>

   
    <div class="container">
        <form method="post" action="">
          

            <label for="data_consulta">Data:</label>
            <input type="date" id="data_consulta" name="data_consulta" required>

            <label for="hora_consulta">Hora:</label>
            <input type="time" id="hora_consulta" name="hora_consulta" required>

            <label for="plano">Escolha um Plano:</label>
            <select id="plano" name="plano" required>
                <option value="Plano Básico" <?= $plano_selecionado == 'Plano Básico' ? 'selected' : '' ?>>Plano Básico - Consulta única</option>
                <option value="Plano Avançado" <?= $plano_selecionado == 'Plano Avançado' ? 'selected' : '' ?>>Plano Médio - Acompanhamento por 3 consultas</option>
                <option value="Plano Premium" <?= $plano_selecionado == 'Plano Premium' ? 'selected' : '' ?>>Plano Premium - Acompanhamento completo</option>
            </select>

              <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="descricao">Descrição (opcional):</label>
            <textarea id="descricao" name="descricao"></textarea>

            <?php if ($erro_login): ?>
                <p class="erro"><?php echo $erro_login; ?></p>
            <?php endif; ?>
            <?php if ($erro_horario): ?>
                <p class="erro"><?php echo $erro_horario; ?></p>
            <?php endif; ?>

            <button type="submit">Agendar Consulta</button>
        </form>

      
    </div>
</body>
</html>
