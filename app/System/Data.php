<?php


namespace App\System;

use App\Models\Document;
use App\Models\Person;

class Data{
    private static $file_path = __DIR__."/../../data/data.json";
    private static $data_stream;
    private static $data_string;


    private static function fetchData():array|string
    {
        $str = file_get_contents(self::$file_path , true);

        $arr  = json_decode($str , true);

        return $arr;
    }


    public static function addDocument(Document $document){
        $json = self::fetchData();
        array_push($json['documents'] ,$document->getDataAsJson());

        $file = fopen(self::$file_path , "w" , true);

        fwrite($file , json_encode($json));
    }

    public static function addPerson(Person $person){
        $json = self::fetchData();

        array_push($json['persons'] ,$person->getDataAsJson());

        $file = fopen(self::$file_path , "w" , true);

        fwrite($file , json_encode($json));
    }
}


?>