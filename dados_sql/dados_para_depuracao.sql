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
    fk_produtos_cod INTEGER NOT NULL REFERENCES produto (cod),
    fk_vendas_numero INTEGER NOT NULL REFERENCES vendas (numero),
    quant_vendida INTEGER,
    PRIMARY KEY(fk_produtos_cod,fk_vendas_numero)
);

INSERT INTO categoria (descricao) VALUES ('Placa de vídeo');
INSERT INTO categoria (descricao) VALUES ('Processador');
INSERT INTO categoria (descricao) VALUES ('Monitor');
INSERT INTO categoria (descricao) VALUES ('TV');

INSERT INTO cliente (nome, cpf, telefone, email, limite_cred, estado, cidade, endereco) VALUES ('Calebe Márcio Yuri Moraes', '903.898.881-84', '(69)98298-9900', 'calebe_moraes@jonasmartinez.com', 4607, 'RO', 'Ariquemes', 'Rua Maringá');
INSERT INTO cliente (nome, cpf, telefone, email, limite_cred, estado, cidade, endereco) VALUES ('Lúcia Bruna Ribeiro', '591.431.862-97', '(38)99728-2660', 'lucia.bruna.ribeiro@engeco.com.br', 1477, 'MG', 'Montes Claros', 'Rua C');
INSERT INTO cliente (nome, cpf, telefone, email, limite_cred, estado, cidade, endereco) VALUES ('Giovanni Renan Ramos', '202.603.555-50', '(47)99698-1931', 'giovanni-ramos96@vbrasildigital.net', 2584, 'SC', 'Blumenau', 'Rua Gustav Tribess');
INSERT INTO cliente (nome, cpf, telefone, email, limite_cred, estado, cidade, endereco) VALUES ('Davi Benedito Moreira', '410.695.692-67', '(67)99228-6981', 'davi_benedito_moreira@contjulioroberto.com.br', 5520, 'MS', 'Três Lagoas', 'Alameda 9');

INSERT INTO produto (nome, preco, qtd_estoque, unidade_medida, fk_categoria_id) VALUES ('RTX 3080', 4800, 5, 'me', 1);
INSERT INTO produto (nome, preco, qtd_estoque, unidade_medida, fk_categoria_id) VALUES ('RTX 3080 TI', 5500, 3, 'me', 1);
INSERT INTO produto (nome, preco, qtd_estoque, unidade_medida, fk_categoria_id) VALUES ('Monitor LG - 26WQ500', 800, 1000, 'po', 3);
INSERT INTO produto (nome, preco, qtd_estoque, unidade_medida, fk_categoria_id) VALUES ('Smart TV 32” HD LED TCL S615 VA', 1139, 2, 'po', 4);

INSERT INTO vendedor (nome, endereco, cidade, estado, telefone, porc_comissao) VALUES ('Luiza Priscila Pietra Costa', 'Rua dos Martin-Pescadores', 'Várzea Grande', 'MT', '(65)98714-1338', 51);
INSERT INTO vendedor (nome, endereco, cidade, estado, telefone, porc_comissao) VALUES ('Flávia Pietra Lima', 'Rua Nove', 'Timon', 'MA', '(86)98839-2586', 78);
INSERT INTO vendedor (nome, endereco, cidade, estado, telefone, porc_comissao) VALUES ('Catarina Hadassa Freitas', 'Rua Padre Custódio Dias', 'São João Del Rei', 'MG', '(32)99693-1363', 25);
INSERT INTO vendedor (nome, endereco, cidade, estado, telefone, porc_comissao) VALUES ('Melissa Isabelle Sueli Campos', 'Rua Quatorze', 'Rio de Janeiro', 'RJ', '(21)99469-8163', 54);