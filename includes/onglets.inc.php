<?php

// Cette fonction est appelée pour la construction de chaque onglet ($i est la 
// position de l'onglet dans la barre)
function construireMenu($nom, $adr, $i) {
    // On récupère l'adresse de la page
    $url = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);
    $queryString = filter_input(INPUT_SERVER, 'QUERY_STRING', FILTER_SANITIZE_STRING);
    if ($queryString !== '') {
        $pageActuelle = substr($url, strrpos($url, '/') + 1) . '?' . $queryString;
    } else {
        $pageActuelle = substr($url, strrpos($url, '/') + 1);
    }
    if (!isset($_COOKIE['username'])) {
        $pageActuelle = 'index.php';
    }

    // Si l'onglet est déjà ouvert, le lien est inactif
    if ($pageActuelle === $adr) {
        echo '<li class="onglet" name="' . $nom . '"><a href="">' . $nom . '</a></li>';
    } else {
        echo '<li class="onglet"><a href="' . $adr . '">' . $nom . '</a></li>';
    }
}
