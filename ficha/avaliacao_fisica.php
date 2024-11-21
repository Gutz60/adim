<?php
session_start();
include('db.php'); // Conexão com o banco de dados

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Inserir nova avaliação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $peso = $_POST['peso'];
    $imc = $_POST['imc'];
    $gordura = $_POST['gordura'];

    $sql = "INSERT INTO avaliacoes_fisicas (usuario_id, peso, imc, porcentagem_gordura) VALUES ('$usuario_id', '$peso', '$imc', '$gordura')";
    $conn->query($sql);
}

// Buscar avaliações existentes
$sql = "SELECT * FROM avaliacoes_fisicas WHERE usuario_id = $usuario_id ORDER BY data_avaliacao DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Avaliação Física</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Avaliações Físicas</h2>
    <form action="avaliacao_fisica.php" method="POST">
        <div>
            <label for="peso">Peso (kg):</label>
            <input type="number" step="0.1" name="peso" required>
        </div>
        <div>
            <label for="imc">IMC:</label>
            <input type="number" step="0.1" name="imc" required>
        </div>
        <div>
            <label for="gordura">Gordura Corporal (%):</label>
            <input type="number" step="0.1" name="gordura" required>
        </div>
        <button type="submit">Adicionar Avaliação</button>
    </form>
    <h3>Histórico de Avaliações</h3>
    <div class="card-container">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="card">
                <p><strong>Data:</strong> <?php echo date('d/m/Y', strtotime($row['data_avaliacao'])); ?></p>
                <p><strong>Peso:</strong> <?php echo $row['peso']; ?> kg</p>
                <p><strong>IMC:</strong> <?php echo $row['imc']; ?></p>
                <p><strong>Gordura Corporal:</strong> <?php echo $row['porcentagem_gordura']; ?>%</p>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
