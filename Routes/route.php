<?php

$route_path = $_SERVER['REQUEST_URI'];

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