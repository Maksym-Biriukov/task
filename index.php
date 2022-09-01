<?php

require_once "vendor/autoload.php";
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$subdir = $_ENV['SUBDIR'];
session_start();

require_once "Views/Common/head.php";
require_once "Config/DB.php";
require_once "Routes/route.php";




        
        

        
        

require_once "Views/Common/end.php";
$conn->close();
 ?>