<?php


namespace App\System;

use App\Models\Person;

class FileSystem{
    private static $store_path = __DIR__."/../../storage/";
    private static $templates_path  = __DIR__."/../templates/";
    private static $data_path = __DIR__."/../../data";


    public static function saveAs($file , $name){
        if($name == "" || $file == NULL){
            throw new CustomExeption("bad file" , 500);
        }
    }


    public static function Template(string $template_name):string|null{
        $file_name = $template_name.".html";

        $content = file_get_contents(self::$templates_path.$file_name , true);

        if( filesize((self::$templates_path.$file_name)) < 50 ){
            throw new CustomExeption("bad file" , 500);
        }

        return $content;
    }


    public static function push(string $template , array $data){
        $f = $template;

        foreach($data as $key =>$val){
            $f = str_replace("$".$key , $val , $f);
        }

        return $f;
    }


    public static function addDocument(string $name , Person $person){
        $data = file_get_contents(self::$data_path."/data.json" , true);
        $json = json_decode($data , true);

        $json['documents'] += [$name => ( $person->getData()['prenom']." ".$person->getData()['nom'] )];
        $json['persons'] += [ $person->getData()['id'] => $person->getData()];

        $f = fopen( self::$data_path."/data.json" , "w");

        fwrite($f , json_encode($json) , strlen( json_encode($json) ));

    }

    public static function makeDocument(string $html , string $name){
        $file = fopen( self::$data_path."/documents/".$name.".html" , "w" );

        fwrite($file , $html , strlen($html));

        fclose($file); 
    }

    public static function existe(string $nom , string $prenom):string|bool{
        $file_content = file_get_contents(self::$data_path."/data.json" , true);

        $json = json_decode($file_content , true);

        $documents = $json['documents'];

        foreach($documents as $key => $val){
            if($val == $prenom." ".$nom){
                return $key;
            }
        }

        return false;
    }

    public static function count(){
        $i = 0;
        $data = file_get_contents( self::$data_path."/data.json" , true );
        $data = json_decode($data , true);
        $persons = $data['persons'];

        foreach($persons as $person){
            $i++;
        }

        return $i;
    }

    public static function getPerson(string $nom , string $prenom):array|bool{
        $data = file_get_contents( self::$data_path."/data.json" , true );
        $data = json_decode($data , true);
        $persons = $data['persons'];

        foreach($persons as $key => $val){
            if($val['nom'] == $nom && $val['prenom'] == $prenom){
                return $val;
            }
        }
        return false;
    }
}


?>