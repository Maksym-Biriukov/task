<?php
require_once "Models/Manager.php";
session_start();
$chekAuth = function ($next){ 
    
    if(isset($_SESSION['idManager'])){
        $next();
    }else{
        header("Location: ".$_ENV['APP_URL_BASE']."login");
    }
    

}


?>