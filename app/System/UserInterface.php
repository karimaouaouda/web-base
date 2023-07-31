<?php

namespace App\System;

class UserInterface{


    protected static $views_path = __DIR__."/../../interface/";
    public static function view($file_path , $data){
        if( file_exists( self::$views_path.$file_path ) ){
            $file_content = file_get_contents(self::$views_path . $file_path , true);

            foreach ($data as $key => $val) {
                $$key = $val;
            }

            ob_clean();

            ob_start();

            eval('?>'.$file_content.'<?php');

            $result = ob_get_clean();

            return $result;


        }

        throw new \Exception("view $file_path does not existe");
    }

    public static function component($file_path , $data){
        return self::view("/components/".$file_path , $data);
    }
}


?>