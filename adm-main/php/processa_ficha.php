<?php
// Recebendo os focos de treino do formulário
$focos = isset($_POST['focos']) ? $_POST['focos'] : [];
$focos = array_slice($focos, 0, 3); // Garantir que no máximo 3 focos sejam selecionados

// Função para gerar ficha de treino semanal
function gerarFicha($focos) {
    $dias = [
        'Segunda-feira' => 'Treino de Perna',
        'Terça-feira' => 'Treino de Peito',
        'Quarta-feira' => 'Treino de Costas',
        'Quinta-feira' => 'Treino de Ombro',
        'Sexta-feira' => 'Treino de Braço',
        'Sábado' => 'Treino Cardio',
        'Domingo' => 'Descanso'
    ];

    $ficha = [];
    
    foreach ($dias as $dia => $treino) {
        $ficha[$dia] = [];

        if (in_array('perna', $focos) && $treino === 'Treino de Perna') {
            $ficha[$dia][] = 'Agachamento: 4 séries de 12 repetições';
            $ficha[$dia][] = 'Leg Press: 4 séries de 12 repetições';
            $ficha[$dia][] = 'Cadeira Extensora: 3 séries de 15 repetições';
        }

        if (in_array('peito', $focos) && $treino === 'Treino de Peito') {
            $ficha[$dia][] = 'Supino Reto: 4 séries de 10 repetições';
            $ficha[$dia][] = 'Flexão de Braço: 4 séries de 12 repetições';
            $ficha[$dia][] = 'Crucifixo: 3 séries de 15 repetições';
        }

        if (in_array('costas', $focos) && $treino === 'Treino de Costas') {
            $ficha[$dia][] = 'Puxada na Barra Fixa: 4 séries de 10 repetições';
            $ficha[$dia][] = 'Remada Curvada: 4 séries de 12 repetições';
            $ficha[$dia][] = 'Pulley: 3 séries de 15 repetições';
        }

        if (in_array('ombro', $focos) && $treino === 'Treino de Ombro') {
            $ficha[$dia][] = 'Desenvolvimento com Halteres: 4 séries de 12 repetições';
            $ficha[$dia][] = 'Elevação Lateral: 4 séries de 15 repetições';
            $ficha[$dia][] = 'Remada Alta: 3 séries de 12 repetições';
        }

        if (in_array('braço', $focos) && $treino === 'Treino de Braço') {
            $ficha[$dia][] = 'Rosca Direta: 4 séries de 12 repetições';
            $ficha[$dia][] = 'Tríceps Testa: 4 séries de 12 repetições';
            $ficha[$dia][] = 'Rosca Alternada: 3 séries de 15 repetições';
        }

        if ($treino === 'Treino Cardio') {
            $ficha[$dia][] = '30 minutos de corrida ou bicicleta';
        }

        if ($treino === 'Descanso') {
            $ficha[$dia][] = 'Descanso e recuperação';
        }
    }

    return $ficha;
}

$ficha = gerarFicha($focos);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Treino Semanal</title>
    <!-- Incluindo o CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Sua Ficha de Treino Semanal</h1>
        <div class="alert alert-info">
            <h4 class="alert-heading">Focos Principais: <?php echo htmlspecialchars(implode(', ', array_map('ucfirst', $focos))); ?></h4>
            <div class="list-group">
                <?php foreach ($ficha as $dia => $exercicios) : ?>
                    <div class="list-group-item">
                        <h5><?php echo htmlspecialchars($dia); ?></h5>
                        <ul>
                            <?php foreach ($exercicios as $exercicio) : ?>
                                <li><?php echo htmlspecialchars($exercicio); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <a href="about-coach.html" class="btn btn-primary mt-3">Voltar</a>
    </div>

    <!-- Incluindo o JS do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
