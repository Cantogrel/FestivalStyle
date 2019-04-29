<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$repassword = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_STRING);

if(isset($username) && isset($password) && isset($repassword))
{
    try{
        if($password === $repassword)
        {
            if(!$pdo->doesAccountAlreadyExist($username) === 0)
            {
                $pdo->createAccount($username, $password);
                setcookie('username', $username);
                header("Location: index.php");
            }else{
                throw new Exception("Le compte existe déjà");
            }
        }else{
            throw new Exception("Les mots de passes ne correspondent pas.");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

include 'vues/Accueil/v_Enregistrer.php';