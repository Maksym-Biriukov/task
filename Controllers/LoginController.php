<?php
require_once "Models/Manager.php";

if (isset($_POST['login']) && isset($_POST['password'])){
    $login = $_POST['login'];
    $pswd = $_POST['password'];

    $id = $Manager['getId']($login);

    var_dump($id);
    exit();
}
else{
    die("Login or password aren't set");
}




?>