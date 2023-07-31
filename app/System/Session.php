<?php

namespace App\System;


class Session{


    private static $session;

    public static function hasUser() : bool{
        self::$session = $_SESSION;
        if( self::has('auth') && self::has('user') ){
            return true;
        }

        return false;
    }

    public static function has(string $key) : bool{
        self::$session = $_SESSION;
        if( !empty(self::$session) && isset(self::$session[$key]) ){
            return true;
        }

        return false;
    }

    public static function get($key){
        self::$session = $_SESSION;
        return self::has($key) ? self::$session[$key] : null;
    }

    public static function refresh(){
        if( session_id() ){
            session_destroy();
        }
        session_start();
        self::$session = $_SESSION;
    }
}


?>