<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$identiteResponsable = filter_input(INPUT_POST, 'identiteResponsable', FILTER_SANITIZE_STRING);
$adressePostale = filter_input(INPUT_POST, 'adressePostale', FILTER_SANITIZE_STRING);
$nombrePersonnes = filter_input(INPUT_POST, 'nombrePersonnes', FILTER_SANITIZE_NUMBER_INT);  
$nomPays = filter_input(INPUT_POST, 'nomPays', FILTER_SANITIZE_STRING);
$hebergement = filter_input(INPUT_POST, 'hebergement', FILTER_SANITIZE_STRING);
$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$repassword = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_STRING);
if(isset($nom) && isset($identiteResponsable) && isset($adressePostale) && isset($nombrePersonnes) 
        && isset($nomPays) && isset($hebergement) && isset($login) && isset($password) && isset($repassword))
{
    try{
        if($password === $repassword)
        {
            if($pdo->doesAccountAlreadyExist($login,$nom) === "0")
            {
                $pdo->createAccount($nom, $identiteResponsable, $adressePostale, $nombrePersonnes, $nomPays, $hebergement, $login, $password);
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