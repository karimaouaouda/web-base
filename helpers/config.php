<?php


$config = array(
    "APP_URL"   => "http://".$_SERVER["HTTP_HOST"],
    "APP_NAME"  => "HALIMIFLIX",
    "APP_DESCRIPTION" =>"halimi flix is a minasssa for watching films anywhere you want, the best films ever",
    "APP_ADRESS"   => "Guelma, Heleopolis 24008",
    "APP_EMAIL" => "karimaouaouda.officiel@gmail.com",
    "APP_PHONE" => "+213655766709",

    "middlewares" => array(
        "auth" => App\System\Middlewares\Authenticate::class
    ),

    "connection" => array(
        "USERNAME"   => "root" ,
        "DB_NAME"  => "nadir",
        "DB_PASS"  => "",
        "DB_HOST"  =>"localhost"
    ),
);



?>