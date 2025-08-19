<?php
class Convenio
{
    private ?int $id;
    private string $empresa;
    private string $cnpj;
    private string $telefone;
    private string $email;
    private string $paciente_id;


    public function __construct(?int $id, $empresa, $cnpj, $telefone, $email,$paciente_id)
    {
        $this->id = $id;
        $this->empresa = $empresa;
        $this->cnpj = $cnpj;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->paciente_id= $paciente_id;
    }
    //GET
    public function getId(){
     return $this->id;
    }
        public function getEmpresa(){
          return $this->empresa;
    }
        public function getCnpj(){
          return $this->cnpj;
    }
        public function getTelefone(){
         return $this->telefone; 
    }
        public function getpaciente_id(){
          return $this->paciente_id;
    }
          public function getEmail(){
          return $this->email;
    }
    //SET
        public function setId(int $id){
      $this->id = $id;
    }
        public function setEmpresa(string $empresa){
           $this->empresa =$empresa;
    }
        public function setCnpj(string $cnpj){
          $this->cnpj = $cnpj;
    }
        public function setTelefone(string $telefone){
          $this->telefone = $telefone; 
    }
        public function setEmail(string $email){
           $this->email = $email;
    }
          public function setPaciente_id(string $paciente_id){
           $this->paciente_id = $paciente_id;
    }
}
