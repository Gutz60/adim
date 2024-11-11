


CREATE TABLE denuncias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    tipo_pessoa ENUM('funcionario', 'cliente') NOT NULL,
    nome_funcionario VARCHAR(100),
    nome_cliente VARCHAR(100),
    descricao_cliente TEXT,
    tipo_incidente ENUM('Assédio', 'Homofobia', 'Machismo', 'Racismo', 'Violência', 'Outro') NOT NULL,
    descricao_ocorrido TEXT NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
