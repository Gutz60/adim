<?php
session_start();
include('db.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtendo os dados do formulário
    $nivel = $_POST['nivel'];
    $idade = $_POST['idade'];
    $sexo = $_POST['sexo'];
    $foco = $_POST['foco'];

    // Obtendo o id do usuário da sessão
    $usuario_id = $_SESSION['usuario_id'];
    
    // Gerar a ficha de treino com base nos dados
    $ficha_treino = generateFicha($nivel, $idade, $sexo, $foco);

    // Inserir os dados na tabela 'informacoes'
    $sql = "INSERT INTO informacoes (usuario_id, nivel, idade, sexo, foco) 
            VALUES ('$usuario_id', '$nivel', '$idade', '$sexo', '$foco')";

    if ($conn->query($sql) === TRUE) {
        // Se a inserção foi bem-sucedida, redireciona para a página de exibição do treino
        header('Location: exibir_treino.php');
    } else {
        echo "Erro ao criar a ficha de treino: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}

// Função que gera a ficha de treino com base nas opções de nível, idade, sexo e foco
function generateFicha($nivel, $idade, $sexo, $foco) {
    $ficha = "<p><strong>Idade:</strong> $idade anos</p>";
    $ficha .= "<p><strong>Sexo:</strong> " . ucfirst($sexo) . "</p>";
    $ficha .= "<p><strong>Objetivo:</strong> Focar em " . ucfirst($foco) . "</p>";
    $ficha .= "<h3>Plano de Treino</h3>";

    // Gerando a ficha de treino com base no nível e foco
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
