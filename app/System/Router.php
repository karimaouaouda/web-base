<?php

namespace App\System;
use App\Controllers\Controller;
use App\System\Routing\UriManager;
use App\System\Routing\Route;


class Router{
    protected static array $getMatches = [];
    protected static array $postMatches = [];

    public static string $currentMatch;

    public static function get($uri , $callback){

        if( !is_callable($callback) ){

            $parts = explode("|" , $callback);


            if( !class_exists("App\\Controllers\\".$parts[0]) ){
                throw new \Exception("error : class $parts[0] undeclared");
            }


            if( method_exists("App\\Controllers\\" . $parts[0] , $parts[1]) ){
                $func = ("App\\Controllers\\" . $parts[0])::getFuncByName($parts[1]);
                $route = new Route($uri, $func);
                self::$getMatches += [$uri => $route];

                return $route;
            }
            throw new \Exception("error : function $parts[1] not found in $parts[0]");
        }

        $route = new Route($uri , $callback);
        self::$getMatches += [$uri => $route];

        return $route;
    }

    public static function post($uri , $callback){

        if (!is_callable($callback)) {

            $parts = explode("|", $callback);


            if (!class_exists("App\\Controllers\\" . $parts[0])) {
                throw new \Exception("error : class $parts[0] undeclared");
            }


            if (method_exists("App\\Controllers\\" . $parts[0], $parts[1])) {
                $func = ("App\\Controllers\\" . $parts[0])::getFuncByName($parts[1]);
                $route = new Route($uri, $func);
                self::$postMatches += [$uri => $route];

                return $route;
            }
            throw new \Exception("error : function $parts[1] not found in $parts[0]");
        }
        $route = new Route($uri, $callback);
        self::$postMatches += [$uri => $route];
    }

    public static function defineAction($method , UriManager $uri) : Route {

        if($method == "GET"){
            $uri = self::getRouteMatchWith($uri , self::$getMatches);
            if( $uri == null ){
                throw new \Exception("undefined route");
            }
            return self::$getMatches[$uri];
        }else{
            $uri = self::getRouteMatchWith($uri , self::$postMatches);
            if ($uri == null) {
                throw new \Exception("undefined route");
            }
            return self::$postMatches[$uri];
        }
    }


    protected static function getRouteMatchWith(UriManager $uri , array $routes){
        foreach($routes as $route => $action){
            if( self::isCanBe($route , $uri) ){
                $uri->setRoute($route);
                self::$currentMatch = $route;
                return $route;
            }

        }

        return null;
    }


    protected static function isCanBe(string $route , UriManager $uri){
        $rout = trim($route , " /");
        return $uri->isMatch($rout);
    }


    public static function registerRouters(){
        include_once(__DIR__."/../../web/routes.php");
    }

    public static function getMatches(){
        return self::$getMatches;
    }



    public static function getRouteByName(string $name){
        foreach( self::$getMatches as $key => $route ){
            if( $route->getName() == $name ){
                return $route;
            }
        }

        foreach (self::$postMatches as $key => $route) {
            if ($route->getName() == $name) {
                return $route;
            }
        }

        return null;
    }
}



?>