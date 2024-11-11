function gerarFicha() {
    // Coleta os dados do formulário
    const nivel = document.getElementById('nivel').value;
    const idade = document.getElementById('idade').value;
    const sexo = document.getElementById('sexo').value;
    const foco = document.querySelector('input[name="foco"]:checked').value;

    // Criação da ficha de treino baseada nas respostas
    let ficha = `<p><strong>Idade:</strong> ${idade} anos</p>
                 <p><strong>Sexo:</strong> ${sexo.charAt(0).toUpperCase() + sexo.slice(1)}</p>
                 <p><strong>Objetivo:</strong> Focar em ${foco}</p>`;

    // Adiciona o plano de treino com base no nível de exercício e foco
    ficha += `<h3>Plano de Treino</h3>`;
    if (nivel === "sedentario") {
        ficha += "<p>Treino para iniciantes, 3 vezes por semana.</p>";
        if (foco === "musculacao") {
            ficha += `<ul>
                        <li>Segunda: Full Body (exercícios leves, 3 séries de 12 repetições)</li>
                        <li>Quarta: Cardio leve (caminhada ou bicicleta por 30 minutos)</li>
                        <li>Sexta: Full Body (exercícios leves, 3 séries de 12 repetições)</li>
                    </ul>`;
        } else if (foco === "cardio") {
            ficha += `<ul>
                        <li>Segunda: Caminhada rápida (30 minutos)</li>
                        <li>Quarta: Bicicleta ou Elíptico (30 minutos)</li>
                        <li>Sexta: Caminhada ou Corrida leve (30 minutos)</li>
                    </ul>`;
        } else if (foco === "perdaPeso") {
            ficha += `<ul>
                        <li>Segunda: Caminhada (30 minutos)</li>
                        <li>Quarta: Cardio (caminhada ou bicicleta por 30 minutos)</li>
                        <li>Sexta: Circuito de exercícios leves para queima de gordura (3 séries de 12 repetições)</li>
                    </ul>`;
        }
    } else if (nivel === "intermediario") {
        ficha += "<p>Treino para nível intermediário, 4-5 vezes por semana.</p>";
        if (foco === "musculacao") {
            ficha += `<ul>
                        <li>Segunda: Peito e tríceps (4 séries de 10-12 repetições)</li>
                        <li>Terça: Cardio moderado (corrida ou elíptico por 40 minutos)</li>
                        <li>Quarta: Costas e bíceps (4 séries de 10-12 repetições)</li>
                        <li>Sexta: Pernas e ombro (4 séries de 10-12 repetições)</li>
                    </ul>`;
        } else if (foco === "cardio") {
            ficha += `<ul>
                        <li>Segunda: Corrida intervalada (20 minutos de corrida + 10 minutos de caminhada)</li>
                        <li>Quarta: Bicicleta (45 minutos com variação de ritmo)</li>
                        <li>Sexta: HIIT (20 minutos de exercícios de alta intensidade)</li>
                    </ul>`;
        } else if (foco === "perdaPeso") {
            ficha += `<ul>
                        <li>Segunda: Cardio moderado (40 minutos)</li>
                        <li>Terça: Musculação focada em resistência (4 séries de 15 repetições)</li>
                        <li>Quarta: HIIT (30 minutos)</li>
                        <li>Sexta: Circuito de queima de gordura (4 séries)</li>
                    </ul>`;
        }
    } else if (nivel === "avancado") {
        ficha += "<p>Treino avançado, 5-6 vezes por semana.</p>";
        if (foco === "musculacao") {
            ficha += `<ul>
                        <li>Segunda: Peito e tríceps (5 séries de 8-10 repetições)</li>
                        <li>Terça: Cardio intenso (HIIT ou corrida por 40 minutos)</li>
                        <li>Quarta: Costas e bíceps (5 séries de 8-10 repetições)</li>
                        <li>Quinta: Pernas (5 séries de 8-10 repetições)</li>
                        <li>Sexta: Ombro e abdominais (5 séries de 8-10 repetições)</li>
                    </ul>`;
        } else if (foco === "cardio") {
            ficha += `<ul>
                        <li>Segunda: HIIT (40 minutos)</li>
                        <li>Terça: Corrida de longa distância (60 minutos)</li>
                        <li>Quarta: HIIT (30 minutos)</li>
                        <li>Sexta: Circuito cardio (45 minutos)</li>
                    </ul>`;
        } else if (foco === "perdaPeso") {
            ficha += `<ul>
                        <li>Segunda: HIIT + Musculação (5 séries de 10 repetições)</li>
                        <li>Terça: Cardio moderado (45 minutos)</li>
                        <li>Quarta: Musculação focada em resistência (5 séries de 12 repetições)</li>
                        <li>Sexta: HIIT + Cardio (30 minutos)</li>
                    </ul>`;
        }
    }

    // Exibir a ficha de treino gerada
    document.getElementById('resultadoFicha').innerHTML = ficha;
    document.getElementById('fichaTreino').style.display = 'block';
}
