<?php
class Consultas
{
    private ?int $id;
    private string $data;
    private string $horas;
    private string $especialidade;
    private int $paciente_id;
    private int $medico_id;

    public function __construct(?int $id,$data,$horas,$especialidade,$paciente_id,$medico_id)
    {
        $this->id = $id;
        $this->data = $data;
        $this->horas = $horas;
        $this->especialidade = $especialidade;
        $this->paciente_id = $paciente_id;
         $this->medico_id = $medico_id;  
    }
      //Get
    public function getId(){
        return $this->id;
    }
      public function getData(){
        return $this->data;
    }
      public function getHoras(){
        return $this->horas;
    }
      public function getEspecialidade(){
        return $this->especialidade;
    }
      public function getPaciente_id(){
        return $this->paciente_id;
    }
      public function getMedico_id(){
        return $this->medico_id;
    }
      //Set
    public function setId(int $id){
     $this->id = $id;
    }
      public function setData(string $data){
    $this->data =$data;
    }
      public function setHoras(string $horas){
      $this->horas = $horas;
    }
      public function setEspecialidade(string $especialidade){
     $this->especialidade = $especialidade;
    }
      public function setPaciente_id(int $paciente_id){
     $this->paciente_id = $paciente_id;
    }
      public function setMedico_id(int $medico_id){
     $this->medico_id = $medico_id;
    }

}
