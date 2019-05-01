<!--OBTENIR LE DÉTAIL DE L"ÉTABLISSEMENT SÉLECTIONNÉ-->
<br>
<table class="tabNonQuadrille" id="TabDetailEtablissement">

    <tr class="enTeteTabNonQuad">
        <td colspan="3"><strong><?= $unEtab->nom ?></strong></td>
    </tr>
    <tr class="ligneTabNonQuad">
        <td> Id: </td>
        <td><?= $unEtab->id ?></td>
    </tr>
    <tr class="ligneTabNonQuad">
        <td> Adresse: </td>
        <td><?= $unEtab->adresseRue ?></td>
    </tr>
    <tr class="ligneTabNonQuad">
        <td> Code postal: </td>
        <td><?= $unEtab->codePostal ?></td>
    </tr>
    <tr class="ligneTabNonQuad">
        <td> Ville: </td>
        <td><?= $unEtab->ville ?></td>
    </tr>
    <tr class="ligneTabNonQuad">
        <td> Téléphone: </td>
        <td><?= $unEtab->tel ?></td>
    </tr>
    <tr class="ligneTabNonQuad">
        <td> E-mail: </td>
        <td><?= $unEtab->adresseElectronique ?></td>
    </tr>
    <tr class="ligneTabNonQuad">
        <td> Type: </td>
        <?php
        if ($unEtab->type === "1") {

            ?>
            <td> Etablissement scolaire </td>
            <?php
        } else {

            ?>
            <td> Autre établissement </td>
            <?php
        }

        ?>
    </tr>
    <tr class="ligneTabNonQuad">
        <td> Responsable: </td>
        <td><?= $unEtab->civiliteResponsable ?>&nbsp; <?= $unEtab->nomResponsable ?>&nbsp; <?= $unEtab->prenomResponsable ?></td>
    </tr> 
</table>
<br>
<a href="?uc=gestEtabs">Retour</a>
