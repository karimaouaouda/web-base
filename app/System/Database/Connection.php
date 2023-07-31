<?php


namespace App\System\Database;
use PDO;
use PDOException;

class Connection{

    protected $pdo;

    public function __construct($host = "localhost" , $user = "root" , $dbname = "" , $password = ""){
        try{
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;" , $user , $password);
        }catch(PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }


    public function getConnection(){
        return $this->pdo;
    }
}




?>