<?php
include __DIR__."/../vendor/autoload.php";

ini_set('session.save_handler', 'files');



use App\System\Application as myApp;

$app = new myApp($_SERVER);

/*foreach($_SERVER as $info => $val){
    echo $info . "====> ". $val."<br>";
}*/

$s = $app->get_response();

print_r($s);




?>