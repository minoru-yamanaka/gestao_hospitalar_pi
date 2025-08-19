<?php
class Medicos
{
    private ?int $id;
    private string $nome;
    private string $especialidade;
    private string $crm;

    public function __construct(?int $id, $nome, $especialidade, $crm)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->especialidade = $especialidade;
        $this->crm = $crm;
    }
//Get
    public function getId(){
        return $this->id;
    }
      public function getNome(){
        return $this->nome;
    }
      public function getEspecialidade(){
        return $this->especialidade;
    }
      public function getCrm(){
        return $this->crm;
    }

//Set
    public function setId(int $id){
     $this->id= $id;
    }
      public function setNome(string $nome){
     $this->nome = $nome;
    }
      public function setEspecialidade(string $especialidade){
     $this->especialidade =$especialidade;
    }
      public function setCrm(string $crm){
     $this->crm = $crm;
    }
}
