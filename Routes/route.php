<?php

$subdir = $_ENV['SUBDIR'];

function url_decode($subdir, $url_decoded){
    return str_replace("/$subdir", '', $url_decoded);
};

function url_encode($subdir, $url_encoded) {
    return "/$subdir".$url_encoded;
};


$route_path = url_decode($subdir, $_SERVER['REQUEST_URI']);


switch ($route_path) {

    case '':
    case '/':
        require_once "Controllers/IndexController.php";
        break;

    case '/login':
        require_once "Controllers/LoginController.php";
        break;

    case '/cart':
        require_once "Controllers/ProductsController.php";
        break;

    case '/about':
        require_once "Controllers/IndexController.php";
        break;

    default:
        http_response_code(404);
        require_once "404.html";
        break;
}


?>