<?php
class Conexao{
    public static function getInstance(){
        $db_dbhost = "localhost";
        $db_name = "gestao_hospitalar";
        $db_user = "root";
        $db_pass = "";
        try{
        $pdo =new PDO("mysql:host={$db_dbhost};dbname={$db_name};",$db_user,$db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
         return $pdo;
        }catch(PDOException $e){
         // Em produção, gravar isso em um LOG    
        die("Erro de conexão com o banco".$e->getMessage());
        }


    }
}
 //$pdo = Conexao::getInstance();
?>

<!-- config file for database connection -->

<!-- <?php
class Conexao
{
    public static function getInstance(): PDO
    {
        $host = "localhost";
        $bd   = "u952185621_GHPIS";
        $user = "u952185621_minoruyamanaka";
        $pass = "Teste#40028922";
        $charset = "utf8";

        $dsn = "mysql:host={$host};dbname={$bd};charset={$charset}";

        try {
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }
}
?> -->
