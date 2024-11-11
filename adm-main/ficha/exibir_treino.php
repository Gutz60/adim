<?php
session_start();
include('db.php');


if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];


$sql = "SELECT dados_adicionais FROM informacoes WHERE usuario_id = $usuario_id ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ficha_treino = $row['dados_adicionais'];
} else {
    $ficha_treino = "Você ainda não possui uma ficha de treino.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ficha de Treino</title>
  <link rel="stylesheet" href="treino.css">
</head>
<body>
  <div class="container">
    <h2 class="titulo">Bem-vindo à sua Ficha de Treino</h2>
    <div class="cartoes">
      <?php if ($ficha_treino !== "Você ainda não possui uma ficha de treino.") : ?>
        <?php $ficha_parts = explode("\n", $ficha_treino); ?>
        <?php foreach ($ficha_parts as $part) : ?>
          <div class="cartao">
            <h2 class="cartao-titulo"><?php echo $part; ?></h2>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="cartao">
          <p class="cartao-descricao"><?php echo $ficha_treino; ?></p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>