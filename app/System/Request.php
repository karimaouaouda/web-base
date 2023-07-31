<?php

namespace App\System;

use App\System\Routing\RouteBinder;
use Closure;
use Exception;
use ReflectionFunction;
use App\System\Router;
use App\System\Routing\UriManager;

class Request
{
    private $method;
    public $uri;
    public $data;

    public $files;
    private $bindings;
    private $server;
    public $response;

    public $uriManager;


    public $try;
    public function __construct($server)
    {
        $this->server = $server;

        $this->method = $server['REQUEST_METHOD'];
        if( isset( $server['PATH_INFO'] ) ){
            $uri = $server['PATH_INFO'];
            if( rtrim($uri) == "" ){
                $this->uri = "/";
            }else{
                $this->uri = trim($uri , "/");
            }
        }else{
            $this->uri = "/";
        }


        $this->uriManager = new UriManager($this->uri);
        if ($this->method == "GET") {
            $this->data = $_GET;
        } else {
            $this->data = $_POST;
        }

        if( isset($_FILES) ){
            $this->files = $_FILES;
        }
    }

    public function file($key) {
        return $this->files[$key];
    }

    public function get(string $key)
    {
        if (!isset($this->data[$key]))
            return NULL;
        return $this->data[$key];
    }


    public function post(string $key)
    {
        if (!isset($this->data[$key]))
            return NULL;
        return $this->data[$key];
    }


    public function route()
    {

        $route = Router::defineAction($this->method, $this->uriManager);

        $function = $route->getCallable();

        if( $function == null ){
            return;
        }

        $ref = new ReflectionFunction($function);

        $expectArgs = $this->uriManager->getArgs();

        $parametters = $ref->getParameters();

        $willpass = RouteBinder::bind($parametters , $this->uriManager);

        if(count($parametters) > 0){
            RouteBinder::bind($parametters , $this->uriManager);
        }

        if( !(count($parametters) == count($willpass) ) ){
            throw new Exception("sorry you must define the args and parameters");
        }

        if (count($parametters) > 0) {
            $args = $this->retrieveArg($parametters);
        }else{
            $obj = NULL;
            $args = [];
        }
        


        $call = Closure::bind($route->getCallable() , null);
        $this->response = $call(...$willpass);
    }

    


    private function retrieveArg(array $params){
        //echo "daa";
        return ["name"=>"jj"];
    }


    

    public function finally()
    {
        return $this->response;
    }
}
