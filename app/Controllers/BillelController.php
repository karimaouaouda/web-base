<?php

namespace App\Controllers;

use App\Controllers\Controller;

class BillelController extends Controller{

    public static function index(): string
    {
        return "hello from " . self::class;
    }

    public static function billel()
    {
        return "saif";
    }
}


?>