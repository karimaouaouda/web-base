<?php

use App\System\Request;
use App\System\Router;

Router::get("/" , "Controller|index" )->name('home');

?>