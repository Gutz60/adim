<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'adm'; // Nome do banco de dados atualizado
$user = 'root';
$password = '';

// Conectar ao banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $nome = $_POST['name'] ?? '';
    $telefone = $_POST['phone'] ?? '';
    $tipoPessoa = $_POST['personType'] ?? '';
    $nomeFuncionario = ($tipoPessoa === 'funcionario') ? $_POST['employeeName'] : null;
    $nomeCliente = ($tipoPessoa === 'cliente') ? $_POST['clientName'] : null;
    $descricaoCliente = ($tipoPessoa === 'cliente') ? $_POST['clientDescription'] : null;
    $tipoIncidente = $_POST['incidentType'] ?? '';
    $descricaoOcorrido = $_POST['incidentDescription'] ?? '';

    // Inserir os dados na tabela "denuncias"
    $sql = "INSERT INTO denuncias (nome, telefone, tipo_pessoa, nome_funcionario, nome_cliente, descricao_cliente, tipo_incidente, descricao_ocorrido) 
            VALUES (:nome, :telefone, :tipoPessoa, :nomeFuncionario, :nomeCliente, :descricaoCliente, :tipoIncidente, :descricaoOcorrido)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':tipoPessoa', $tipoPessoa);
    $stmt->bindParam(':nomeFuncionario', $nomeFuncionario);
    $stmt->bindParam(':nomeCliente', $nomeCliente);
    $stmt->bindParam(':descricaoCliente', $descricaoCliente);
    $stmt->bindParam(':tipoIncidente', $tipoIncidente);
    $stmt->bindParam(':descricaoOcorrido', $descricaoOcorrido);

    if ($stmt->execute()) {
        echo "Denúncia enviada com sucesso!";
    } else {
        echo "Erro ao enviar a denúncia. Tente novamente.";
    }
}
?>
