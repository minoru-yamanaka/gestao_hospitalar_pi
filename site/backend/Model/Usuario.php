<?php
class Usuario
{
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $token;

public function __construct(?int $id,$nome,$email,$senha,$token){
$this->id = $id;
$this->nome = $nome;
$this->email = $email;
$this->senha = $senha;
$this->token = $token;

}
//get
public function getId(){
    return $this->id;
}
public function getNome(){
    return $this->nome;
}
public function getEmail(){
    return $this->email;
}
public function getSenha(){
    return $this->senha;
}
public function getToken(){
    return $this->token;
}


    
}

