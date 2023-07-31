<?php

namespace App\System;
use Exception;


class Application{
    public $response;
    
    private static Request $request;


    public function __construct($server_array = null)
    {
        session_start();
        if($server_array == null){
            throw new Exception("must use sserver",505);
        }
        $request = new Request($server_array);

        self::$request = $request;

        Router::registerRouters();

        $request->route();
        $this->response = $request->finally();
    }

    public static function getCurrentRequest(){
        return self::$request;
    }

    public function get_response(){
        return $this->response;
    }
}


?>