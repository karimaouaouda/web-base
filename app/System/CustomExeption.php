<?php

namespace App\System;

use Exception;

class CustomExeption extends Exception{
    public function __construct($exeption , $code)
    {
        throw new Exception($exeption , $code);
    }
}


?>