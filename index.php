<?php
    namespace Core;
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');

    spl_autoload_register(function($class) {
        $root = $_SERVER['DOCUMENT_ROOT'];
        $ds = DIRECTORY_SEPARATOR;

        $namespace_arr = explode('\\', $class);
        $arr_amount_elems = count($namespace_arr);
        $relative_path = [];
        for($i = 0; $i < $arr_amount_elems; $i++) {
            if($i !== $arr_amount_elems - 1) $relative_path[] = mb_strtolower($namespace_arr[$i]);
            else $relative_path[] = $namespace_arr[$i];
        }
        $path = $root.$ds.implode($ds, $relative_path).".php";
        require_once($path);
    });

    $routes = require($_SERVER['DOCUMENT_ROOT'].'/project/config/routes.php');
    $track = (new Router)->getTrack($routes, $_SERVER['REQUEST_URI']);

    echo var_dump($track);