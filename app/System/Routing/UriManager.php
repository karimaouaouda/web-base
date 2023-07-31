<?php


namespace App\System\Routing;
use App\System\Router;

class UriManager{
    protected $parts = array();

    protected $argPosition = array();


    protected $matcher = array();
    protected $route;
    public function __construct(string $uri){
        if($uri === "/"){
            array_push($this->parts , "/");
        }else{
            $uri = trim($uri , "/");
            $parts = explode("/", $uri, PHP_INT_MAX);

            foreach($parts as $part){
                $this->parts[] = $part;
            }

        }
    }

    public function setRoute(string $route){
        $this->route = $route;
    }

    public function getMatcher(){
        return $this->matcher;
    }


    public function isMatch(string $route) : bool{
        if( ($route == "/" || $route == "") && in_array("/" , $this->parts) ){
            return true;
        }

        $routeParts = explode( "/",trim( $route , "/" ) );


        if( count($routeParts) != count($this->parts) ){
            return false;

        }


        foreach( $routeParts as $key => $rpart ){
            if( $rpart === $this->parts[$key] ){
                continue;
            }

            if( $this->isParmeter($rpart) ){
                continue;
            }
            return false;
        }

        return true;
    }

    private function isParmeter(string $val): bool{
        $a = [];
        return preg_match("{{\w+}}" , $val );
    }

    public function getArgs(): array|null
    {
        $args = array();

        if( Router::$currentMatch == "/" ){
            return $args;
        }else{
            $parts = explode("/" , trim(Router::$currentMatch , " /"));
        }

        $i = 0;
        foreach( $parts as $part ){
            if( $this->isParmeter($part) ){
                $this->matcher += [trim($part , " {}") => $this->parts[$i]];
                array_push($args , $part);
            }
            $i++;
        }

        if (count($args) == 0)
            return array();

        return $args;
    }
}