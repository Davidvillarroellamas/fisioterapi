<?php

    class Database{
        private $host='localhost';
        private $user='root';
        private $password='';
        private $database='fisioterapia';

        public function getConnection(){
            $hostDB="mysql:host=".$this->host.";dbname=".$this->database.";";

            try {
                $connection= new PDO($hostDB,$this->user,$this->password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connection;
            } catch (PDOException $e) {
                die("ERROR DE CONEXION A LA BASE DE DATOS:: ".$e->getMessage());
            }
        }
    }

?>