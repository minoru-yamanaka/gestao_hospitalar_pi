<?php 
require_once '../Conexao.php';
require_once '../backend/Model/Consulta.php';

class ConsultaDAO{
    private $bd;
    public function __construct()
    {
      $this->bd = Conexao::getInstance();  
    }
    public function getAll(){
        $sql="SELECT * FROM consultas";
        $consultas=[];
        $stmt= $this->bd->query($sql);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         $consultas[] = new Consultas($row['id'],
                                      $row['data'],
                                      $row['horas'],
                                      $row['especialidade'],
                                      $row['paciente_id'],
                                      $row['medico_id']               
        );
        }
        return $consultas;
    }
        public function getById($id):? Consultas{
        $sql="SELECT * FROM consultas WHERE id=:id";
        $stmt= $this->bd->prepare($sql);
        $stmt->execute([':id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Consultas($row['id'],
                                      $row['data'],
                                      $row['horas'],
                                      $row['especialidade'],
                                      $row['paciente_id'],
                                      $row['medico_id']               
        ):null;
        }

        public function create(Consultas $consultas){
        $sql="INSERT INTO consultas(data,horas,especialidade,paciente_id,medico_id) 
        VALUES(:data,:horas,:especialidade,:paciente_id,:medico_id)";
          $stmt= $this->bd->prepare($sql);
        $stmt->execute([':data'=>$consultas->getData(),
                        ':horas'=>$consultas->getHoras(),
                        ':especialidade'=>$consultas->getEspecialidade(),
                        ':paciente_id'=>$consultas->getPaciente_id(),
                        ':medico_id'=>$consultas->getMedico_id()
    ]);
        }
            public function update(Consultas $consultas){
        $sql="UPDATE consultas SET data=:,horas=:horas,especialidade=:especialidade,paciente_id=:paciente_id,medico_id=:medico_id WHERE id=:id"; 
          $stmt= $this->bd->prepare($sql);
        $stmt->execute([':id'=>$consultas->getId(),
                        ':data'=>$consultas->getData(),
                        ':horas'=>$consultas->getHoras(),
                        ':especialidade'=>$consultas->getEspecialidade(),
                        ':paciente_id'=>$consultas->getPaciente_id(),
                        ':medico_id'=>$consultas->getMedico_id()
    ]);
        }
        public function excluir( $id){
        $sql="DELETE FROM consultas  WHERE id=:id"; 
        $stmt= $this->bd->prepare($sql);
        $stmt->execute([':id'=>$id ]);
        }
    }


?>