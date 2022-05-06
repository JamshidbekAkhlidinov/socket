<?php

class DbConnect{

    private $host = "localhost";
    private $dbName = "websocket";
    private $user = "root";
    private $pass = "root";

    public function  connect(){
        try {
            $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName,$this->user,$this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch (PDOException $e){
                echo  "Dastabase Error: ".$e->getMessage();
        }
    }

}