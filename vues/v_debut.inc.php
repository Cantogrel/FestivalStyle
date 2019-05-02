<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
    "http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
    <head>
        <title>Festival</title>
        <meta http-equiv="Content-Language" content="fr">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="css/cssGeneral.css" rel="stylesheet" type="text/css">
        <link href="css/cssOnglets.css" rel="stylesheet" type="text/css">

        <?php
        $uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
        if (empty($uc)) {
            $uc = 'accueil';
        }
        switch ($uc) {
            case 'accueil':

                break;
            case 'enregistrer':

                break;
            case 'gestEtabs':
                echo '<link href="/css/css_GestionEtablissements.css" rel="stylesheet" type="text/css"/>';
                break;
            case 'gestTypesChambres':
                echo '<link href="css/css_GestionTypesChambres.css" rel="stylesheet" type="text/css"/>';
                break;
            case 'offreHeberge':
                echo '<link href="../css/css_OffreHebergement.css" rel="stylesheet" type="text/css"/>';
                break;
            case 'attribChambres':
                echo '<link href="css/css_AttributionChambres.css" rel="stylesheet" type="text/css"/>';
                break;
        }
        ?>
    </head>
    <body class='basePage'>
        <img id="banniere" src="../images/banniere.jpg" alt=""/>

        <!--  Tableau contenant le titre et les menus -->

        <!-- Menus -->
        <!-- On inclut le fichier de gestion des onglets ; si on a des 
        menus traditionnels, il faudra inclure le fichier adéquat -->
        <?php include('includes/onglets.inc.php'); ?>
    <nav>
        <ul>
            <?php construireMenu('Accueil', 'index.php', 1); ?>
            <?php construireMenu('Gestion établissements', 'index.php?uc=gestEtabs', 2); ?>
            <?php construireMenu('Gestion types chambres', 'index.php?uc=gestTypesChambres', 3); ?>
            <?php construireMenu('Offre hébergement', 'index.php?uc=offreHeberge', 4); ?>
            <?php construireMenu('Attribution chambres', 'index.php?uc=attribChambres', 5); ?>
            <?php construireMenu('Se Déconnecter', 'index.php?uc=deconnecter', 6); ?>
        </ul>
    </nav>
    <table class="TabOnglet">
        <tr>
            <td class="basePage">
