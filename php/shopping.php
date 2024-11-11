<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho ADM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/shopping.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <header>
        <button id="btn-voltar"><i class="bi bi-arrow-left-circle"></i></button>
        <h2 id="title">Carrinho A.D.M</h2>
    </header>
    <section>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Produto</th>
                <th scope="col">Preço</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Configurações de conexão
              $host = 'localhost';
              $dbname = 'minha_loja';
              $username = 'root'; // Ajuste de acordo com o seu servidor
              $password = '';     // Normalmente vazio para XAMPP

              try {
                  // Conexão com o banco de dados
                  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  // Consulta para obter todos os produtos
                  $sql = "SELECT * FROM produtos";
                  $stmt = $pdo->query($sql);

                  $total = 0; // Variável para calcular o total do carrinho

                  while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $subtotal = $produto['preco'] * $produto['quantidade'];
                    $total += $subtotal;
                    echo "<tr>";
                    echo "<th scope='row'><img src='{$produto['imagem']}' alt='' width='10%'> {$produto['nome']}</th>";
                    echo "<td>R$" . number_format($produto['preco'], 2, ',', '.') . "</td>";
                    echo "<td>{$produto['quantidade']}</td>";
                    echo "<td><strong>R$" . number_format($subtotal, 2, ',', '.') . "</strong></td>";
                    echo "</tr>";
                }                
              } catch (PDOException $e) {
                  echo "Erro de conexão: " . $e->getMessage();
              }
              ?>
            </tbody>
          </table>
          <div class="card" style="width: 18rem;">
            <div class="card-header">
              Subtotal
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"> <strong>R$<?php echo number_format($total, 2, ',', '.'); ?></strong></li>
            </ul>
          </div>
          <button id="btn-pagamento" class="btn btn-primary">Ir para o pagamento</button>
    </section>
</body>
</html>
