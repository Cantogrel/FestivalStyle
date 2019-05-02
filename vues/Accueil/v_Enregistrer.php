
<form id="login" action="index.php" method="POST">
    <br>
    <table class="tabNonQuadrille">
        <tr class="enTeteTabNonQuad">
            <td colspan="3"><b>Ajouter un groupe de folklore</b></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Nom du groupe : </span></td>
            <td><input id="nom" name="nom" type="text" size="20"/></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Nom du responsable : </span></td>
            <td><input id="identiteResponsable" name="identiteResponsable" type="text" size="20"/></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Adresse postale : </span></td>
            <td><input id="adressePostale" name="adressePostale" type="text" size="20"/></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Nombre de personnes : </span></td>
            <td><input id="nombrePersonnes" name="nombrePersonnes" type="number" size="20"/></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Pays : </span></td>
            <td><input id="nomPays" name="nomPays" type="text" size="20"/></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Hébergement : </span></td>
            <td><input id="hebergement" name="hebergement" type="text" size="20"/></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Identifiant : </span></td>
            <td><input id="login" name="login" type="text" size="20"/></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Mot de passe : </span></td>
            <td><input id="password" name="password" type="password" size="20"/></td>
        </tr>
        <tr class="ligneTabNonQuad">
            <td><span>Confirmer le mot de passe : </span></td>
            <td><input id="repassword" name="repassword" type="password" size="20"/></td>
        </tr>
    </table>
    <input type="submit" value="S'enregistrer" />
</form>