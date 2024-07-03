<?php

use App\Controllers\BillelController;
use App\System\Router;
use App\System\Request;

Router::get("/" , "Controller|index" )->name('home');

Router::get('/billel' , "BillelController|index")->name("billel");

Router::get("/saif" , [BillelController::class , "billel"] );

Router::get('/karim' , function(Request $r){ //binding reuest simple example (not with container)
    return $r;
});
//
//Router::get('/param/{saf}', function(string $saf){
//    return $saf;
//});
?>