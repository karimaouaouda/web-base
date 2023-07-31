<?php

namespace App\System\Routing;
use App\System\Application;
use Closure;
use Exception;
use ReflectionParameter;


/**
 * Summary of RouteBinder
 */
class RouteBinder{

    protected static UriManager $uriManger;

    protected static Closure $function;

    protected static $matches = array();



    /**
     * Summary of bind
     * @param array $parmetters
     * @param UriManager $uri
     * @return array|null
     */
    public static function bind(array $parmetters, UriManager $uri) : array|null {
        if( count($parmetters) == 0 ){
            return array();
        }

        foreach ($parmetters as $key => $val) {
            if ($val->getType() == "App\System\Request") {
                self::$matches += [$val->getName() => Application::getCurrentRequest()];
            }else{
                $paramName = $val->getName();

                if( array_key_exists($paramName , $uri->getMatcher()) ){
                    self::$matches += [$paramName => $uri->getMatcher()[$paramName]];
                }else{
                    throw new Exception("not found param with name : ".$val->getName()."<br>");
                }
            }
        }

        return self::$matches;

    }

    public static function tryToBind(ReflectionParameter $param){
        if( class_exists( $param->getType() ) ){
            
        }
    }




}

?>