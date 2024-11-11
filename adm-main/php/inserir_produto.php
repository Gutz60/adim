<?php
// Configurações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'minha_loja';
$username = 'root';
$password = '';

try {
    // Conexão com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o formulário foi enviado com todos os campos necessários
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco']) && isset($_POST['quantidade']) && isset($_POST['imagem'])) {

        // Captura os valores do formulário
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];
        $imagem = $_POST['imagem']; // Caminho da imagem fornecido no formulário

        // Consulta SQL para inserir os dados na tabela
        $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade, imagem) VALUES (:nome, :descricao, :preco, :quantidade, :imagem)";
        
        // Preparação da consulta
        $stmt = $pdo->prepare($sql);
        
        // Associação de valores aos parâmetros da consulta
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':imagem', $imagem);

        // Execução da consulta e verificação
        if ($stmt->execute()) {
            // Redireciona de volta para o formulário após a inserção
            header("Location: info_produtos.html?success=1");
            exit();
        } else {
            echo "Erro ao inserir o produto.";
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
