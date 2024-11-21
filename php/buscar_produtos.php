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

    // Captura a consulta de busca
    $busca = isset($_GET['busca']) ? $_GET['busca'] : '';

    // Consulta SQL para buscar produtos
    $sql = "SELECT * FROM produtos WHERE nome LIKE :busca";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':busca', "%$busca%", PDO::PARAM_STR);
    $stmt->execute();

    // Exibe os produtos ou mensagem de erro
    if ($stmt->rowCount() > 0) {
        while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "
            <div class='col-md-4 mb-4'>
                <div class='card'>
                    <img src='{$produto['imagem']}' class='card-img-top' alt='{$produto['nome']}' id='image-card'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$produto['nome']}</h5>
                        <p class='card-text'>{$produto['descricao']}</p>
                        <p class='card-text'><strong>Preço: </strong> R$ {$produto['preco']}</p>
                        <button class='btn btn-primary'>Adicionar ao Carrinho</button>
                    </div>
                </div>
            </div>
            ";
        }
    } else {
        echo "<div class='not-found'>Item '{$busca}' não encontrado</div>";
    }
} catch (PDOException $e) {
    echo "<p>Erro ao carregar os produtos: " . $e->getMessage() . "</p>";
}
?>
