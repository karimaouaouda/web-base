<?php

namespace App\Controllers;
use Closure;

abstract class Controller{
    public static function getFuncByName(string $name) : Closure | null {
        if( !method_exists(static::class , $name) ){
            return null;
        }else{
            
            return (new \ReflectionMethod( static::class ."::".$name))->getClosure();
        }
    }


    public static function index(){
        return view("login.php");
    }

    
}



?>