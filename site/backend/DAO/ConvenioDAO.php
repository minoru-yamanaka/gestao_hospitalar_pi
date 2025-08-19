<?php 
require_once '../backend/Model/Convenio.php';
require_once '../Conexao.php';

class ConvenioDAO{
    private $bd;

    public function __construct()
    {
        $this->bd = Conexao::getInstance();
    }

public function getAll(){
    $sql="SELECT convenio.*,pacientes.nome AS pacientes_nome FROM convenio JOIN pacientes on convenio.paciente_id=pacientes.id;";
  $convenios=[];
    $stmt = $this->bd->query($sql);
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $convenios[] =new Convenio($row['id'],
                               $row['empresa'],
                               $row['cnpj'],
                               $row['telefone'],
                               $row['email'],
                                $row['paciente_id']
    );
    }
    return $convenios;
}
public function getById($id):? Convenio{
    $sql="SELECT * FROM convenio WHERE id=:id";
    $stmt = $this->bd->prepare($sql);
    $stmt->execute([':id'=>$id]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?new Convenio($row['id'],
                               $row['empresa'],
                               $row['cnpj'],
                               $row['telefone'],
                               $row['email'],
                               $row['paciente_id']
    ):null;
    }
    public function create(Convenio $convenio){
        $sql="INSERT INTO convenio(empresa,cnpj,telefone,email,paciente_id) VALUES(:empresa,:cnpj,:telefone,:email,:paciente_id)";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([
            ':empresa'=>$convenio->getEmpresa(),
            ':cnpj'=>$convenio->getCnpj(),
            ':telefone'=>$convenio->getTelefone(),
            ':email'=>$convenio->getEmail(),
            ':paciente_id'=>$convenio->getPaciente_id()
    ]);
    }
        public function update(Convenio $convenio){
        $sql="UPDATE convenio SET empresa=:empresa,cnpj=:cnpj,telefone=:telefone,email=:email,paciente_id= :paciente_id WHERE id =:id";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([
             ':id'=>$convenio->getId(),
            ':empresa'=>$convenio->getEmpresa(),
            ':cnpj'=>$convenio->getCnpj(),
            ':telefone'=>$convenio->getTelefone(),
            ':email'=>$convenio->getEmail(),
            ':paciente_id'=>$convenio->getPaciente_id()
    ]);
    }
         public function excluir( $id){
        $sql="DELETE FROM convenio  WHERE id =:id";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([
             ':id'=>$id ]);
    }

}


?>