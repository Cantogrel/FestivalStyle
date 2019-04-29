<?php
require_once 'includes/gestionErreurs.inc.php';
require_once 'modele/class.pdofestival.inc.php';
include 'includes/pdo-debug.php';

$pdo = PdoFestival::getPdoFestival();

require 'vues/v_debut.inc.php';


if($uc === 'deconnecter')
{
    setcookie('username','');
}
if((empty($_COOKIE['username']) || $uc === 'deconnecter' ) && $uc !== 'enregistrer'){
    include 'controleurs/c_Login.php';
    $uc = 'accueil';
} else {    
    switch ($uc) {
        case 'accueil':
            include 'vues/Accueil/v_Accueil.php';
            break;
        case 'enregistrer':
            include './controleurs/c_Enregistrer.php';
            break;
        case 'gestEtabs':
            include './controleurs/c_GestionEtablissements.php';
            break;
        case 'gestTypesChambres':
            include './controleurs/c_GestionTypesChambres.php';
            break;
        case 'offreHeberge':
            include './controleurs/c_OffreHebergement.php';
            break;
        case 'attribChambres':
            include './controleurs/c_AttributionChambres.php';
            break;
    }
}


require 'vues/v_fin.inc.php';
