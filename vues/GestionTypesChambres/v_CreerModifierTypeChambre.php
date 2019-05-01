<?php
// CRÉER OU MODIFIER UN TYPE DE CHAMBRE

?>

<form method="POST" action="?uc=gestTypesChambres&action=<?= $action ?>">
    <br>
    <table class="tabNonQuadrille" id="TabCreerModifierTypeChambre">

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
                <td><input type="text" value="<?= $id ?>" name="id" size="2" maxlength="2"></td>
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
            <td><input type="text" value="<?= $libelle ?>" name="libelle" size="30" maxlength="25"></td>
        </tr>
    </table>
    <div class="BtnValidReturn">
        <input type="submit" value="Valider" name="valider">
        <input type="reset" value="Annuler" name="annuler">
    </div>
    <a href="?uc=gestTypesChambres">Retour</a>
</form>
