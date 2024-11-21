<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'academia';
$user = 'seu_usuario';
$password = 'sua_senha';

// Conectar ao banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

$message = 'Agradecemos sua denúncia.
Lembre-se: a culpa não é sua!'; 

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $nome = $_POST['name'] ?? '';
    $telefone = $_POST['fone'] ?? '';
    $tipoPessoa = $_POST['personType'] ?? '';
    $nomeFuncionario = $tipoPessoa === 'funcionario' ? $_POST['employeeName'] ?? '' : null;
    $nomeCliente = $tipoPessoa === 'cliente' ? $_POST['name'] ?? '' : null;
    $descricaoCliente = $tipoPessoa === 'cliente' ? $_POST['message'] ?? '' : null;
    $tipoIncidente = $_POST['incidentType'] ?? '';
    $descricaoOcorrido = $_POST['message'] ?? '';

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
