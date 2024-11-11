CREATE DATABASE minha_loja;
USE minha_loja;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade INT NOT NULL,
    data_adicionado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
