<?php
// SÉLECTIONNER LE NOMBRE DE CHAMBRES SOUHAITÉES

?>
<form method='POST' action='?uc=attribChambres&action=validerModifierAttrib'>
    <input type='hidden' value='<?= $idEtab ?>' name='idEtab'>
    <input type='hidden' value='<?= $idTypeChambre ?>' name='idTypeChambre'>
    <input type='hidden' value='<?= $idGroupe ?>' name='idGroupe'>
    <?php
    $nomGroupe = $pdo->obtenirNomGroupe($idGroupe);

    ?>
    <p>Combien de chambres de type <?= $idTypeChambre ?> souhaitez-vous pour le groupe <?= $nomGroupe ?> ?</p>
        <select name='nbChambres'>
            <?php
            for ($i = 0; $i <= $nbChambres; $i++) {

                ?>
                <option><?= $i ?></option>
                <?php
            }

            ?>
        </select>
    <div class="BtnValidReturn">
        <input type='submit' value='Valider' name='valider'>
        <input type='reset' value='Annuler' name='Annuler'>
    </div>
    <a href='?uc=attribChambres&action=demanderModifierAttrib'>Retour</a>
</form>     