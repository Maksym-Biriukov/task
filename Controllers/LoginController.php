<?php
require_once "Models/Manager.php";

if (isset($_POST['login_form'])){
    if (isset($_POST['login']) && isset($_POST['password'])){
        $login = $_POST['login'];
        $pswd = md5(md5($_POST['password']));

        $id = $Manager['getId']($login);
        if (isset($id['error'])){
            die($id['error']);
        }
        var_dump($id);
    }

    else{
        die("Login or password aren't set");
    }
}
else{
    require_once "Views/Login/login.php";
}




?>