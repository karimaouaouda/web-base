<?php


namespace App\System\Middlewares;

use App\System\Request;
use App\System\Auth;
use App\System\Routing\Redirect;
use App\System\Middlewares\Middleware;

class Authenticate extends Middleware{

    public function assert(Request $request){
        if( !Auth::check() ){
            $this->error = "you must be logged in";

            return Redirect::to( route("loginView") );
        }

        return true;
    }
}

?>