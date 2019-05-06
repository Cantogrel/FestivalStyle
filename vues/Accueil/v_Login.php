<script src="js/ControleForm.js"></script>
<link href="css/cssFormulaire.css" rel="stylesheet" type="text/css"/>

<form id="login" action="index.php" method="POST">
    <table class="tabNonQuadrille">
        <br>
        <tr class="enTeteTabNonQuad">
            <td colspan="3"><b>Se connecter</b></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Identifiant : </span></td>
            <td class="inpForm"><input id="username" name="username" type="text" size="20" required><div></div></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Mot de passe : </span></td>
            <td class="inpForm"><input id="password" name="password" type="password" size="20" required><div></div></td>
        </tr>
    </table>
    <input type="submit" name="valider" value="Se connecter" />
</form>