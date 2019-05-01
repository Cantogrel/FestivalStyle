<!--
    CRÉER OU MODIFIER UN TYPE DE CHAMBRE
-->

<script src="js/ControleForm.js"></script>
<link href="css/cssFormulaire.css" rel="stylesheet" type="text/css"/>

<form method="POST" action="?uc=gestTypesChambres&action=<?= $action ?>">
    <br>
    <table width="40%" cellspacing="0" cellpadding="0" class="tabNonQuadrille">

        <tr class="enTeteTabNonQuad">
            <td colspan="3"><strong><?= $message ?></strong></td>
        </tr>
        <?php
        // En cas de création, l"id est accessible sinon l"id est dans un champ
        // caché
        if ($creation) {

            ?>
            <tr class="ligneTabNonQuad">
                <td> Id*: </td>
                <td class="inpForm"><input type="text" value="<?= $id ?>" name="id" size="2" maxlength="2" pattern="^[0-9A-Z]+$" required><div></div></td>
            </tr>
            <?php
        } else {

            ?>
            <tr class="autreLigne">
                <td><input type="hidden" value="<?= $id ?>" name="id"></td><td></td>
            </tr>
            <?php
        }

        ?>
        <tr class="ligneTabNonQuad">
            <td> Libellé*: </td>
            <td class="inpForm"><input type="text" value="<?= $libelle ?>" name="libelle" size="30" maxlength="25" required><div></div></td>
        </tr>
    </table>
    <table align="center" cellspacing="15" cellpadding="0">
        <tr>
            <td align="right"><input type="submit" value="Valider" name="valider"></td>
            <td align="left"><input type="reset" value="Annuler" name="annuler"></td>
        </tr>
    </table>
    <a href="?uc=gestTypesChambres">Retour</a>
</form>
