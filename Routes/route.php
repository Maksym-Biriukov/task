<?php
require_once "Controllers/IndexController.php";
require_once "Controllers/AuthController.php";
require_once "Controllers/LoginController.php";
require_once "Controllers/ProductsController.php";


function url_decode($subdir, $url_encoded){
    return str_replace("/$subdir", '', $url_encoded);
};

function url_encode($subdir, $url_decoded) {
    return "/$subdir".$url_decoded;
};


$route_path = url_decode($subdir, $_SERVER['REQUEST_URI']);


switch ($route_path) {

    case '':
    case '/':
    case '/login':
        $login();
        break;

    case '/cart':
        $chekAuth($cart);
        break;

    case '/about':
        break;

    default:
        http_response_code(404);
        require_once "404.html";
        break;
}


?>