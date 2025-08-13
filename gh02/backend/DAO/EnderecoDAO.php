<?php
require_once '../Conexao.php';
require_once '../backend/Model/Endereco.php';

class EnderecoDAO{
    private $bd;

    public function __construct()
    {
      $this->bd = Conexao::getInstance();  
    }

    public function getAll(){
        $sql="SELECT * FROM endereco ";
        $enderecos=[];
        $stmt=$this->bd->query($sql);
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $enderecos[] = new Endereco(
            $row['id'],
            $row['logradouro'],
            $row['bairro'],
            $row['cidade'],
            $row['estado'],
              $row['paciente_id']
            );
        }
        return $enderecos;
    }
        public function getById($id):?Endereco{
        $sql="SELECT * FROM endereco WHERE id=:id ";
          $stmt=$this->bd->prepare($sql);
          $stmt->execute([':id'=>$id]);
          $row=$stmt->fetch(PDO::FETCH_ASSOC);
          return $row ? new Endereco(
               $row['id'],
            $row['logradouro'],
            $row['bairro'],
            $row['cidade'],
            $row['estado'],
            $row['paciente_id']
          ):null;

    }
        public function create(Endereco $endereco){
        $sql="INSERT INTO endereco (logradouro,bairro,cidade,estado,paciente_id)VALUES(:logradouro,:bairro,:cidade,:estado,:paciente_id) ";
        $stmt=$this->bd->prepare($sql);
        $stmt->execute([':logradouro'=>$endereco->getLogradouro(),
                          ':bairro'=>$endereco->getBairro(), 
                          ':cidade'=>$endereco->getCidade(), 
                          ':estado'=>$endereco->getEstado(),  
                          ':paciente_id'=>$endereco->getPaciente_id()
       ] );
    }
        public function update(Endereco $endereco){
        $sql="UPDATE endereco SET logradouro=:logradouro,bairro=:bairro,cidade=:cidade,estado=:estado,paciente_id=:paciente_id WHERE id=:id ";
         $stmt=$this->bd->prepare($sql);
        $stmt->execute([':id'=>$endereco->getId(),
                         ':logradouro'=>$endereco->getLogradouro(),
                          ':bairro'=>$endereco->getBairro(), 
                          ':cidade'=>$endereco->getCidade(), 
                          ':estado'=>$endereco->getEstado(),  
                          ':paciente_id'=>$endereco->getPaciente_id()
       ] );
    }
        public function excluir($id){
        $sql="DELETE FROM endereco WHERE id=:id ";
        $stmt=$this->bd->prepare($sql);
        $stmt->execute([':id'=>$id]);
    }
}

?>