<?php


if (!function_exists("nadir")) {
    function nadir()
    {
        echo "hello nadir" . "<br>";
    }
}

if( ! function_exists("include_asset") ){
    function include_asset(string $path) : string{
        $host = $_SERVER['HTTP_HOST'];
        return "http://".$host."/".$path;
    }
}


if (!function_exists("config")) {
    function config(string $key): string | null | array
    {
        $file = file_get_contents( __DIR__ ."/config.php" , true);

        eval("?>".$file."<?php");

        return $config[$key] ?? null;
    }
}


if (!function_exists("view")) {
    function view(string $viewname , array $data = []): string|null|array
    {
        return \App\System\UserInterface::view($viewname , $data);
    }
}

if (!function_exists("component")) {
    function component(string $viewname, array $data = []): string|null|array
    {
        return \App\System\UserInterface::component($viewname, $data);
    }
}


if (!function_exists("isAuth")) {
    function isAuth(): bool
    {
        if( !session_id() ){
            session_start();
        }

        return isset( $_SESSION['user'] );
    }
}

if (!function_exists("session")) {
    function session($key): string|null|array
    {
        if (!session_id()) {
            session_start();
        }

        return $_SESSION[$key] ?? null;
    }
}

if (!function_exists("route")) {
    function route(string $name , array $params = array()): string | null
    {

        $route = App\System\Router::getRouteByName($name);

        if( $route == null ){
            throw new \Exception("undefined name route $name");
        }

        $url = config("APP_URL").$route->getRoute();

        return $url;
    }
}


?>