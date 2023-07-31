<?php


namespace App\System\Routing;


use App\System\Application as App;

class Redirect{



    public static function to($url){
        $to = $url ?? config("APP_URL");
        App::getCurrentRequest()->response = "<meta http-equiv='refresh'
   content='0; url=$url'>";
    }
}




?>