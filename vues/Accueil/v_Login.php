<link href="css/cssFormulaire.css" rel="stylesheet" type="text/css"/>

<form id="login" action="index.php" method="POST">
    <table class="tabNonQuadrille">
        <br>
        <tr class="enTeteTabNonQuad">
            <td colspan="3"><b>Se connecter</b></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Identifiant : </span></td>
            <td><input id="username" name="username" type="text" size="20" required></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Mot de passe : </span></td>
            <td><input id="password" name="password" type="password" size="20" required></td>
        </tr>
    </table>
    <input type="submit" value="Se connecter" />
</form>