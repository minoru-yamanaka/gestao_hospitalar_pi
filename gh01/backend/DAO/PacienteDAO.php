<?php
require_once '../Conexao.php';
require_once '../backend/Model/Paciente.php';


class PacienteDAO
{
     private $bd;

    public function __construct()
    {

        $this->bd = Conexao::getInstance();
    }
    public function getAll()
    {

        $sql = "SELECT * FROM pacientes";
        $pacientes = [];
        $stmt = $this->bd->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pacientes[] = new Paciente(
                $row['id'],
                $row['nome'],
                $row['sobrenome'],
                $row['data_nascimento'],
                $row['sexo'],
                $row['data_cadastro']
            );
        }
        return $pacientes;
    }
    public function getById($id): ?Paciente
    {

        $sql = "SELECT * FROM pacientes WHERE id=:id";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Paciente(
            $row['id'],
            $row['nome'],
            $row['sobrenome'],
            $row['data_nascimento'],
            $row['sexo'],
            $row['data_cadastro']
        ) : null;
    }
    public function create(Paciente $pacientes)
    {
        $sql = "INSERT INTO pacientes(nome,sobrenome,data_nascimento,sexo,data_cadastro)
            VALUES(:nome,:sobrenome,:data_nascimento,:sexo,:data_cadastro)";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([
            ':nome' => $pacientes->getNome(),
            ':sobrenome' => $pacientes->getSobrenome(),
            ':data_nascimento' => $pacientes->getData_nascimento(),
            ':sexo' => $pacientes->getSexo(),
            ':data_cadastro' => $pacientes->getData_cadastro()
        ]);
    }
    public function update(Paciente $pacientes)
    {
        $sql = "UPDATE pacientes SET nome=:nome,sobrenome=:sobrenome,data_nascimento=:data_nascimento,sexo=:sexo,data_cadastro=:data_cadastro WHERE id=:id";

        $stmt = $this->bd->prepare($sql);
        $stmt->execute([
             ':id' => $pacientes->getId(),
            ':nome' => $pacientes->getNome(),
            ':sobrenome' => $pacientes->getSobrenome(),
            ':data_nascimento' => $pacientes->getData_nascimento(),
            ':sexo' => $pacientes->getSexo(),
            ':data_cadastro' => $pacientes->getData_cadastro()
        ]);
    }
        public function excluir($id)
    {
        $sql = "DELETE FROM pacientes WHERE id=:id";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
//  $pa =new Paciente(null,"Davi","Silva","1988-04-04","masculino",10-06-2025);
//  $dao =new PacienteDAO();
//  $dao->create($pa);
