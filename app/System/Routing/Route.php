<?php


namespace App\System\Routing;

use App\System\Application;
use Closure;
use Exception;


class Route{

    private Closure $function;
    private string $route;

    private string $name = "";

    protected $middlewares = [];

    public function __construct(string $route, Closure $closure){
        $this->function = $closure;
        $this->route = $route;
    }

    public function getName(){
        return $this->name;
    }
    public function name(string $name)
    {
        $this->name = $name;
    }


    public function middleware(string $middleware){
        $middlewares = config("middlewares");

        if( isset($middlewares[$middleware]) ){
            $obj = $middlewares[$middleware];
            if( class_exists($obj) ){
                $middleware =  (new $obj);

                array_push($this->middlewares , $middleware);
            }else{
                throw new Exception("class $obj does not exist in :".__FILE__." line : ".__LINE__."<br>");
            }
        }else{
            throw new Exception("undefined middleware name $middleware in :" . __FILE__ . " line : " . __LINE__ . "<br>");
        }

        return $this;
    }


    public function getCallable(){
        $a = "";
        if( !$this->isAuthorize($a) ){
            return null;
        }
        return $this->function;
    }

    public function getRoute(){
        return $this->route;
    }


    private function isAuthorize(&$a) : bool{
        $request = Application::getCurrentRequest();
        if( count( $this->middlewares ) != 0 ){
            foreach( $this->middlewares as $middleware ){
                if( !$middleware->assert($request) ){
                    $a = $middleware->getError();
                    return false;
                }
            }
        }


        return true;
    }

}


?>