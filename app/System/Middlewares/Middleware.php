<?php


namespace App\System\Middlewares;

abstract class Middleware
{

    protected $error ; 

    public function getError(){
        return $this->error;
    }

}

?>