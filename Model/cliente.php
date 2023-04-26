<?php
class Cliente{
    private int $cod;
    private String $nome;
    private String $endereco;
    private String $telefone;
    private float $limite_cred;
    private String $cidade;
    private String $email;
    private String $cpf;
    private String $estado;

public function __construct($cod,  $nome,  $endereco, $telefone, $limite_cred, $cidade, $email, $cpf, $estado){
$this->cod = $cod;
$this->nome = $nome;
$this->endereco = $endereco;
$this->telefone = $telefone;
$this->limite_cred = $limite_cred;
$this->cidade = $cidade;
$this->email = $email;
$this->cpf = $cpf;
$this->estado = $estado;
}
}