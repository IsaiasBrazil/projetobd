drop database loja;
create database loja;


CREATE TABLE categoria (
    cod INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100)
);

CREATE TABLE produto (
    cod INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    preco NUMERIC(12, 2),
    qtd_estoque INT,
    unidade_medida CHAR(2),
    fk_categoria_id INT NOT NULL,
    FOREIGN KEY (fk_categoria_id) REFERENCES categoria (cod)
);

CREATE TABLE vendedor (
    cod INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    endereco VARCHAR(100),
    cidade VARCHAR(50),
    estado CHAR(2),
    telefone VARCHAR(15),
    porc_comissao NUMERIC(12, 2)
);

CREATE TABLE cliente (
    cod INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    endereco VARCHAR(100),
    telefone VARCHAR(15),
    limite_cred NUMERIC(12, 2),
    cidade VARCHAR(50),
    email VARCHAR(50),
    cpf VARCHAR(14),
    estado CHAR(2)
);

CREATE TABLE venda (
    numero INT AUTO_INCREMENT PRIMARY KEY,
    data DATE,
    prazo_entrega VARCHAR(10),
    cond_pagto VARCHAR(50),
    fk_cliente_cod INT,
    fk_vendedor_cod INT,
    FOREIGN KEY (fk_cliente_cod) REFERENCES cliente (cod),
    FOREIGN KEY (fk_vendedor_cod) REFERENCES vendedor (cod)
);

CREATE TABLE itens_venda (
    fk_produtos_cod INT NOT NULL,
    fk_vendas_numero INT NOT NULL,
    quant_vendida INT,
    FOREIGN KEY (fk_produtos_cod) REFERENCES produto (cod),
    FOREIGN KEY (fk_vendas_numero) REFERENCES venda (numero)
);