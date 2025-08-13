<?php
class Endereco
{
    private ?int $id;
    private string $logradouro;
    private string $bairro;
    private string $cidade;
    private string $estado;
    private int  $paciente_id;


    public function __construct(?int $id, $logradouro, $bairro, $cidade, $estado, $paciente_id)
    {
        $this->id =  $id;
        $this->logradouro = $logradouro;
        $this->bairro =  $bairro;
        $this->cidade = $cidade;
        $this->estado =  $estado;
        $this->paciente_id = $paciente_id;
    }

    public function getId(){
        return $this-> id;
    }
        public function getLogradouro(){
        return $this-> logradouro;
    }
        public function getBairro(){
        return $this-> bairro;
    }
        public function getCidade(){
        return $this-> cidade;
        }
            public function getEstado(){
        return $this-> estado;
    }
    
        public function getPaciente_id(){
        return $this-> paciente_id;
    }
    public function setId(int $id){
        $this->id= $id;
    }
      public function setLogradouro(string $logradouro){
        $this->id= $logradouro;
    }
      public function setBairro(string $bairro){
        $this->id= $bairro;
    }
      public function setCidade(string $cidade){
        $this->id= $cidade;
    }
      public function setEstado(string $estado){
        $this->id= $estado;
    }
      public function setPaciente_id(int $paciente_id){
        $this->id= $paciente_id;
    }

}
