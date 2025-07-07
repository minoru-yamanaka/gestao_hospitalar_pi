<?php
class Conexao{
    public static function getInstance(){
    $host="localhost";
    $bd="gestao_hospitalar";
    $user="root";
    $pass="";
  
    try{
      $pdo= new PDO("mysql:host={$host};dbname={$bd};",$user,$pass);  
      return $pdo;
    }catch(PDOException $e){
        die("Erro de conexão com o banco!" .$e->getMessage());
    }
    
    }
}
// $pdo = Conexao::getInstance();
?>