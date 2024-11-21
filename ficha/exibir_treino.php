<?php
session_start();
include('db.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Consulta para pegar os dados do usuário
$sql = "SELECT nivel, idade, sexo, foco FROM informacoes WHERE usuario_id = $usuario_id ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nivel = $row['nivel'];
    $idade = $row['idade'];
    $sexo = $row['sexo'];
    $foco = $row['foco'];

    // Gerar a ficha de treino com base nos dados recuperados
    $ficha_treino = generateFicha($nivel, $idade, $sexo, $foco);
} else {
    $ficha_treino = "Você ainda não possui uma ficha de treino.";
}

$conn->close();

// Função que gera a ficha de treino com base nos dados do usuário
function generateFicha($nivel, $idade, $sexo, $foco) {
    $ficha = "<div class='ficha-item'><strong>Idade:</strong> $idade anos</div>";
    $ficha .= "<div class='ficha-item'><strong>Sexo:</strong> " . ucfirst($sexo) . "</div>";
    $ficha .= "<div class='ficha-item'><strong>Objetivo:</strong> Focar em " . ucfirst($foco) . "</div>";
    $ficha .= "<h3 class='treino-titulo'>Plano de Treino</h3>";

    // Gerando o treino com base no nível e foco
    if ($nivel === 'sedentario') {
        $ficha .= "<div class='ficha-item'>Treino para iniciantes, 3 vezes por semana:</div>";
        $ficha .= "<ul class='ficha-list'>
                    <li>Segunda: Exercícios para $foco (3 séries de 12 repetições)</li>
                    <li>Quarta: Cardio leve (30 minutos)</li>
                    <li>Sexta: Repetição do treino de $foco (3 séries de 12 repetições)</li>
                    </ul>";
    } elseif ($nivel === 'intermediario') {
        $ficha .= "<div class='ficha-item'>Treino para nível intermediário, 4-5 vezes por semana:</div>";
        $ficha .= "<ul class='ficha-list'>
                    <li>Segunda: Exercícios compostos para $foco (4 séries de 10-12 repetições)</li>
                    <li>Terça: Cardio moderado (45 minutos)</li>
                    <li>Quarta: Foco em $foco e core (4 séries de 10-12 repetições)</li>
                    <li>Sexta: Cardio (40 minutos de corrida ou elíptico)</li>
                    </ul>";
    } elseif ($nivel === 'avancado') {
        $ficha .= "<div class='ficha-item'>Treino avançado, 5-6 vezes por semana:</div>";
        $ficha .= "<ul class='ficha-list'>
                    <li>Segunda: Exercícios pesados para $foco (5 séries de 8-10 repetições)</li>
                    <li>Terça: Cardio intenso (HIIT por 30 minutos)</li>
                    <li>Quarta: Foco em $foco e resistência (5 séries de 8-10 repetições)</li>
                    <li>Sexta: Cardio intenso (HIIT por 30 minutos)</li>
                    </ul>";
    }

    return $ficha;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Treino</title>
    <link rel="stylesheet" href="style_ficha.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

 

    <div class="container">
        <div class="header">
            <h1>Ficha de Treino Personalizada</h1>
        </div>

        <div class="ficha-container">
            <?php if ($ficha_treino !== "Você ainda não possui uma ficha de treino.") : ?>
                <div class="ficha">
                    <?php echo $ficha_treino; ?>
                </div>
            <?php else : ?>
                <div class="ficha">
                    <p><?php echo $ficha_treino; ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer">
            <a href="../index.html" class="btn-voltar"><i class="bi bi-arrow-left-circle"></i>Voltar</a>
        </div>
    </div>

</body>
</html>
