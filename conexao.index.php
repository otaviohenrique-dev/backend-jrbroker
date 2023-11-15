<?php
    class ConexaoIndex {
            private $host = '172.106.0.113';
            private $dbname = 'jr_broker_db';
            private $user = 'administrador';
            private $pass = '%FCrxvDN47@?pdmA';
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