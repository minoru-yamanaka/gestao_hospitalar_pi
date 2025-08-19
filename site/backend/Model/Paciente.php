<?php
class Paciente{
    private ?int $id;
    private string $nome;
    private string $sobrenome;
    private string $data_nascimento;
    private string $sexo;
    private string $data_cadastro;

    public function __construct(?int $id,$nome,$sobrenome, $data_nascimento,$sexo,$data_cadastro){

     $this->id =  $id;
     $this->nome =  $nome;
     $this->sobrenome = $sobrenome;
     $this->data_nascimento = $data_nascimento;
     $this->sexo = $sexo;
     $this->data_cadastro = $data_cadastro;
    }
     public function getId(){
        return $this->id;
     }
     public function setId(int $id){
     $this->id = $id;
     }

        public function getNome(){
        return $this->nome;
     }
     public function setNome(string $nome){
     $this->nome = $nome;
     }

        public function getSobrenome(){
        return $this->sobrenome;
     }
     public function setSobrenome(string $sobrenome){
     $this->sobrenome = $sobrenome;
     }

    public function getData_nascimento(){
        return $this->data_nascimento;
     }
     public function setData_nascimento(string $data_nascimento){
     $this->data_nascimento = $data_nascimento;
     }

        public function getSexo(){
        return $this->sexo;
     }
     public function setSexo(string $sexo){
     $this->sexo = $sexo;
     }

    public function getData_cadastro(){
        return $this->data_cadastro;
     }
     public function setData_cadastro(string $data_cadastro){
     $this->data_cadastro = $data_cadastro;
     }
    }



?>