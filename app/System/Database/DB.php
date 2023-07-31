<?php

namespace App\System\Database;

use App\System\Database\Connection;




class DB {
    private static $connection;

    private static $sql;


    public static function query($sql){
        self::$sql = $sql;
    }

    public static function getPdoBeforeExecuting($data){
        self::$connection = new Connection(dbname: "tpweb");

        $c = self::$connection->getConnection();

        $c = $c->prepare(self::$sql);

        $c->execute($data);

        return $c;
    }


    public static function get($data){
        self::$connection = new Connection(dbname:"tpweb");

        $c = self::$connection->getConnection();

        $c= $c->prepare(self::$sql);

        $c->execute($data);


        return $c->fetchAll(\PDO::FETCH_ASSOC);


    }
}


?>