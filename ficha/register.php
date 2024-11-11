<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber e sanitizar dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $genero = $_POST['genero'];
    $nivel_exercicio = $_POST['nivel_exercicio'];

  
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $foto = $_FILES['foto']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($foto);

      
if (!file_exists($target_dir)) {
    echo "O diretório de upload não existe. Verifique a configuração do servidor.";
    exit();
}


if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    echo "Desculpe, houve um erro ao fazer o upload do arquivo. O caminho do diretório é: $target_file";
    exit();
}

        
        
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
              
                $query = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, genero, nivel_exercicio, foto) VALUES (?, ?, ?, ?, ?, ?)");
                $query->execute([$nome, $email, $senha, $genero, $nivel_exercicio, $foto]);

            
                $user_id = $pdo->lastInsertId();

              
                $dias = ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado', 'Domingo'];

                $musculos = [
                    'masculino' => [
                        'sedentario' => href="  index.php",
                        'intermediario' => ['Peito e Tríceps', 'Costas e Bíceps', 'Pernas', 'Ombros e Trapézio', 'Peito e Costas', 'Cardio', 'Descanso'],
                        'avancado' => ['Peito e Tríceps', 'Costas e Bíceps', 'Pernas', 'Ombros', 'Peito e Costas', 'Cardio e Abdominais', 'Descanso'],
                    ],
                    'feminino' => [
                        'sedentario' => ['Glúteos', 'Pernas', 'Abdômen', 'Braços', 'Glúteos', 'Cardio', 'Descanso'],
                        'intermediario' => ['Glúteos e Pernas', 'Abdômen e Braços', 'Cardio', 'Pernas e Glúteos', 'Abdômen', 'Cardio', 'Descanso'],
                        'avancado' => ['Glúteos e Pernas', 'Abdômen e Braços', 'Cardio e HIIT', 'Glúteos', 'Pernas e Abdômen', 'Cardio e Abdominais', 'Descanso'],
                    ]
                ];

                $ficha = $musculos[$genero][$nivel_exercicio];

                $ficha_query = $pdo->prepare("INSERT INTO fichas (usuario_id, dia_semana, musculo_preferido, tempo_treino) VALUES (?, ?, ?, ?)");
                foreach ($dias as $index => $dia) {
                    $musculo = $ficha[$index];
                    $tempo_treino = '60'; 
                    $ficha_query->execute([$user_id, $dia, $musculo, $tempo_treino]);
                }

              
                header('Location: index.php');
                exit();
            } else {
                echo "Desculpe, houve um erro ao fazer o upload do arquivo.";
            }
        } else {
            echo "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
        }
    } else {
        echo "Nenhum arquivo foi enviado ou ocorreu um erro no upload.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Cadastro</h2>
    <form method="post" action="register.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <div class="mb-3">
            <label for="genero" class="form-label">Gênero</label>
            <select class="form-select" id="genero" name="genero" required>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nivel_exercicio" class="form-label">Nível de Exercício</label>
            <select class="form-select" id="nivel_exercicio" name="nivel_exercicio" required>
                <option value="sedentario">Sedentário</option>
                <option value="intermediario">Intermediário</option>
                <option value="avancado">Avançado</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
</body>
</html>
