CREATE TABLE categoria (
    cod SERIAL PRIMARY KEY,
    descricao VARCHAR(100)
);

CREATE TABLE produto (
    cod SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    preco NUMERIC(12, 2),
    qtd_estoque INTEGER,
    unidade_medida CHAR(2),
    fk_categoria_id INTEGER REFERENCES categoria (cod)
);

CREATE TABLE vendedor (
    cod SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    endereco VARCHAR(100),
    cidade VARCHAR(50),
    estado CHAR(2),
    telefone VARCHAR(15),
    porc_comissao NUMERIC(12, 2)
);

CREATE TABLE cliente (
    cod SERIAL PRIMARY KEY,
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
    numero SERIAL PRIMARY KEY,
    data DATE,
    prazo_entrega VARCHAR(10),
    cond_pagto VARCHAR(50),
    fk_cliente_cod INTEGER REFERENCES cliente (cod),
    fk_vendedor_cod INTEGER REFERENCES vendedor (cod)
);

CREATE TABLE itens_venda (
    fk_produtos_cod INTEGER NOT NULL REFERENCES produtos (cod),
    fk_vendas_numero INTEGER NOT NULL REFERENCES vendas (numero),
    quant_vendida INTEGER,
    PRIMARY KEY(fk_produtos_cod,fk_vendas_numero)
);