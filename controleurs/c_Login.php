<?php
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

include 'vues/Accueil/v_Accueil.php';
if(isset($username) && isset($password))
{
    if($pdo->testLogin($username,$password) > 0)
    {
        setcookie('username',$username);
    }else{
        include 'vues/Accueil/v_Login.php';
    }
}else {
    include 'vues/Accueil/v_Login.php';
}