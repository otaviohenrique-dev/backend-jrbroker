<?php
    class Conexao {
            private $host = '172.106.0.111';
            private $dbname = 'jr_broker_novo';
            private $user = 'jr_broker_db';
            private $pass = 'T5rzr6b@yF!Rkn7y';
            public function conectar (){
            try{
                $conexao = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname; charset=utf8mb4",
                    "$this->user",
                    "$this->pass",
                    
                );
                return $conexao;
    
            } catch (PDOException $e){
                echo '<p>'.$e->getMessage();
    
            }
    
    
            }
    }
?>