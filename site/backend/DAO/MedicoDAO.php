<?php
require_once '../Conexao.php';
require_once '../backend/Model/Medico.php';

class MedicoDAO{
 private $bd;

 public function __construct()
 {
    $this-> bd = Conexao::getInstance();
 }

 public function getAll(){
    $sql="SELECT * FROM medico";
    $medicos=[];
    $stmt= $this->bd->query($sql);
    while($row =$stmt->fetch(PDO::FETCH_ASSOC)){
   $medicos[] = new Medicos($row['id'],$row['nome'],$row['especialidade'],$row['crm']);
    }
   return $medicos;
 }
  public function getById($id):? Medicos{
      $sql="SELECT * FROM medico WHERE id=:id";  
       $stmt= $this->bd->prepare($sql);
       $stmt->execute([':id'=>$id]);
       $row =$stmt->fetch(PDO::FETCH_ASSOC);
       return $row? new Medicos($row['id'],$row['nome'],$row['especialidade'],$row['crm']): null;
    }
 
  public function create(Medicos $medico){
       $sql="INSERT INTO medico (nome,especialidade,crm)VALUES(:nome,:especialidade,:crm)"; 
        $stmt= $this->bd->prepare($sql);
       $stmt->execute([':nome'=>$medico->getNome(),
                       ':especialidade'=>$medico->getEspecialidade(),
                       ':crm'=>$medico->getCrm()
                    
    ]); 
 }
  public function update(Medicos $medico){
      $sql="UPDATE medico SET nome=:nome,especialidade=:especialidade,crm=:crm WHERE id=:id"; 
        $stmt= $this->bd->prepare($sql);
             
       $stmt->execute([':id'=>$medico->getId(),
                        ':nome'=>$medico->getNome(),  
                       ':especialidade'=>$medico->getEspecialidade(),
                       ':crm'=>$medico->getCrm()
  ]); 
 }

  public function excluir($id){
        $sql="DELETE FROM medico WHERE id=:id";
        $stmt=$this->bd->prepare($sql);
        $stmt->execute([':id'=>$id]);
 }

 

}
?>