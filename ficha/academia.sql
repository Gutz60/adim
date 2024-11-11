

USE adm;

-- Tabela para armazenar informações de login dos usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela para armazenar informações adicionais de cada usuário
CREATE TABLE informacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    dados_adicionais TEXT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE

);

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

CREATE TABLE consultas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    data_consulta DATE NOT NULL,
    hora_consulta TIME NOT NULL,
    descricao TEXT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE avaliacoes_fisicas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    peso DECIMAL(5, 2),
    imc DECIMAL(5, 2),
    porcentagem_gordura DECIMAL(5, 2),
    data_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);