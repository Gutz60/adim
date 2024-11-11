<?php
session_start();
include('db.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html"); // Redireciona para o login
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperando dados do formulário
    $nivel = $_POST['nivel'];
    $idade = $_POST['idade'];
    $sexo = $_POST['sexo'];
    $foco = $_POST['foco'];

    // Recuperando o ID do usuário logado
    $usuario_id = $_SESSION['usuario_id'];

    // Gerando a ficha de treino com base nas respostas
    $dados_adicionais = "Nivel: $nivel, Idade: $idade, Sexo: $sexo, Foco: $foco";

    // Ficha de treino baseada nas respostas
    $ficha_treino = generateFicha($nivel, $idade, $sexo, $foco);

    // Inserindo a ficha de treino no banco de dados
    $sql = "INSERT INTO informacoes (usuario_id, dados_adicionais) VALUES ('$usuario_id', '$ficha_treino')";

    if ($conn->query($sql) === TRUE) {
        header('Location: exibir_treino.php');  // Redireciona para a página que exibe o treino
    } else {
        echo "Erro ao criar a ficha de treino: " . $conn->error;
    }

    // Fechar conexão
    $conn->close();
}

// Função que gera a ficha de treino com base nas opções
function generateFicha($nivel, $idade, $sexo, $foco) {
    $ficha = "<p><strong>Idade:</strong> $idade anos</p>";
    $ficha .= "<p><strong>Sexo:</strong> " . ucfirst($sexo) . "</p>";
    $ficha .= "<p><strong>Objetivo:</strong> Focar em " . ucfirst($foco) . "</p>";
    $ficha .= "<h3>Plano de Treino</h3>";

    // Gerando a ficha com base nas combinações de idade, nível e foco
    if ($nivel === 'sedentario') {
        $ficha .= "<p>Treino para iniciantes, 3 vezes por semana.</p>";
        $ficha .= "<ul>
                    <li>Segunda: Exercícios para $foco (3 séries de 12 repetições)</li>
                    <li>Quarta: Cardio leve (30 minutos)</li>
                    <li>Sexta: Repetição do treino de $foco (3 séries de 12 repetições)</li>
                    </ul>";
    } elseif ($nivel === 'intermediario') {
        $ficha .= "<p>Treino para nível intermediário, 4-5 vezes por semana.</p>";
        $ficha .= "<ul>
                    <li>Segunda: Exercícios compostos para $foco (4 séries de 10-12 repetições)</li>
                    <li>Terça: Cardio moderado (45 minutos)</li>
                    <li>Quarta: Foco em $foco e core (4 séries de 10-12 repetições)</li>
                    <li>Sexta: Cardio (40 minutos de corrida ou elíptico)</li>
                    </ul>";
    } elseif ($nivel === 'avancado') {
        $ficha .= "<p>Treino avançado, 5-6 vezes por semana.</p>";
        $ficha .= "<ul>
                    <li>Segunda: Exercícios pesados para $foco (5 séries de 8-10 repetições)</li>
                    <li>Terça: Cardio intenso (HIIT por 30 minutos)</li>
                    <li>Quarta: Foco em $foco e resistência (5 séries de 8-10 repetições)</li>
                    <li>Sexta: Cardio intenso (HIIT por 30 minutos)</li>
                    </ul>";
    }

    return $ficha;
}
?>
