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
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if (empty($uc)) {
            $uc = 'accueil';
        }
        switch ($uc) {
            case 'accueil':

                break;
            case 'enregistrer':

                break;
            case 'gestEtabs':
                if (empty($action)) {
                    $action = 'initial';
                }
                switch ($action) {
                    case 'detailEtab':
                        echo '<link href="css/GestionEtablissements/css_ObtenirDetailEtablissement.css" rel="stylesheet" type="text/css">';
                        break;

                    case 'demanderCreerEtab':
                        echo '<link href="css/GestionEtablissements/css_CreerModifierEtablissement.css" rel="stylesheet" type="text/css">';
                        break;

                    case 'demanderModifierEtab':
                        echo '<link href="css/GestionEtablissements/css_CreerModifierEtablissement.css" rel="stylesheet" type="text/css">';
                        break;

                    case 'demanderSupprimerEtab':
                        echo '<link href="css/GestionEtablissements/css_SupprimerEtablissement.css" rel="stylesheet" type="text/css">';
                        break;                   
                }
                break;
            case 'gestTypesChambres':

                break;
            case 'offreHeberge':

                break;
            case 'attribChambres':

                break;
        }
        ?>
    </head>
    <body class='basePage'>
        <!--  Tableau contenant le titre et les menus -->
        <table width="100%" cellpadding="0" cellspacing="0">
            <!-- Titre -->
            <tr> 
                <td class="titre">Festival Folklores du Monde <br>
                    <span id="texteNiveau2" class="texteNiveau2">H&eacute;bergement des groupes</span><br>&nbsp;
                </td>
            </tr>
            <!-- Menus -->
            <tr> 
                <td>
                    <!-- On inclut le fichier de gestion des onglets ; si on a des 
                    menus traditionnels, il faudra inclure le fichier adéquat -->
                    <?php include('includes/onglets.inc.php'); ?>

                    <div id='barreMenus'>
                        <ul class='menus'>
                            <?php construireMenu('Accueil', 'index.php', 1); ?>
                            <?php construireMenu('Gestion établissements', 'index.php?uc=gestEtabs', 2); ?>
                            <?php construireMenu('Gestion types chambres', 'index.php?uc=gestTypesChambres', 3); ?>
                            <?php construireMenu('Offre hébergement', 'index.php?uc=offreHeberge', 4); ?>
                            <?php construireMenu('Attribution chambres', 'index.php?uc=attribChambres', 5); ?>
                            <li class="onglet"><a href="index.php?uc=deconnecter">Se Déconnecter</a></li>
                        </ul>
                    </div>

                </td>
            </tr>
            <!-- Fin des menus -->
            <tr>
                <td class="basePage">
                    <br><center><br>


