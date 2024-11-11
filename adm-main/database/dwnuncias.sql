
CREATE TABLE denuncias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    tipo_pessoa ENUM('funcionario', 'cliente') NOT NULL,
    nome_funcionario VARCHAR(255) NULL,
    nome_cliente VARCHAR(255) NULL,
    descricao_cliente TEXT NULL,
    tipo_incidente VARCHAR(50) NOT NULL,
    descricao_ocorrido TEXT NOT NULL,
    data_submissao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
