<?php

namespace App\System;


class Auth{

    public static function check(){
        return Session::hasUser();
    }
}



?>