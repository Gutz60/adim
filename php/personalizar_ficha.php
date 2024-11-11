<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalizar Ficha de Treino</title>
    <!-- Incluindo o CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Personalize Sua Ficha de Treino</h1>
        <form action="gerar_ficha.php" method="post">
            <!-- Nível de Atividade Física -->
            <fieldset class="form-group">
                <legend class="col-form-label">Qual é o seu nível de atividade física?</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nivel" id="sedentario" value="sedentario" required>
                    <label class="form-check-label" for="sedentario">Sedentário</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nivel" id="iniciante" value="iniciante">
                    <label class="form-check-label" for="iniciante">Iniciante</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nivel" id="intermediario" value="intermediario">
                    <label class="form-check-label" for="intermediario">Intermediário</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nivel" id="avancado" value="avancado">
                    <label class="form-check-label" for="avancado">Avançado</label>
                </div>
            </fieldset>

            <!-- Focos de Treino -->
            <div class="form-group">
                <label for="focos">Selecione até 3 focos principais de treino:</label>
                <select class="form-control" id="focos" name="focos[]" multiple required>
                    <option value="perna">Perna</option>
                    <option value="peito">Peito</option>
                    <option value="costas">Costas</option>
                    <option value="ombro">Ombro</option>
                    <option value="braco">Braço</option>
                </select>
                <small id="focoHelp" class="form-text text-muted">Segure Ctrl (ou Command) para selecionar múltiplos focos.</small>
            </div>

            <!-- Frequência de Exercícios -->
            <fieldset class="form-group">
                <legend class="col-form-label">Você está acostumado a fazer exercícios físicos regularmente?</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exercicios" id="exercicios_sim" value="sim" required>
                    <label class="form-check-label" for="exercicios_sim">Sim</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exercicios" id="exercicios_nao" value="nao">
                    <label class="form-check-label" for="exercicios_nao">Não</label>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-primary">Gerar Ficha de Treino</button>
        </form>
    </div>

    <!-- Incluindo o JS do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
