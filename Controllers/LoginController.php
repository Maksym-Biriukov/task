<?php

require_once "Models/Manager.php";

$login = function() use ($Manager, $subdir){

    if (isset($_POST['login_form'])){
        if (isset($_POST['login']) && isset($_POST['password'])){
            $login = $_POST['login'];
            $pswd = md5(md5($_POST['password']));
            // $id = $Manager['getId']($login);
            // if (isset($id['error'])){
                //     die($id['error']);
                // }
                
            $user = $Manager['search'](['login', $_POST['login']]);
            // echo $pswd.'<br>';
            // echo $user[0]['password']; exit;
            // var_dump($pswd==$user[0]['password']); exit;
            if (empty($user)){
                die("WRONG LOGIN!!!");
            }
            session_start();
            if ($pswd==$user[0]['password']){
                $_SESSION['idManager'] = $user[0]['id'];
                unset($_SESSION['error_code']);
                header("Location: ".$_ENV['APP_URL_BASE']."cart");
            }
            else
            {
                $_SESSION['error_code'] = "LOGERR";
                header("Location: ".$_ENV['APP_URL_BASE']."login");
            }
            
        }
    
        else{
            die("Login or password aren't set");
        }
    }
    else{
        require_once "Views/Login/login.php";
    }
}




?>