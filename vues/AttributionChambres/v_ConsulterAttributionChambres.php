<!--
CONSULTER LES ATTRIBUTIONS DE TOUS LES ÉTABLISSEMENTS
IL FAUT QU'IL Y AIT AU MOINS UN ÉTABLISSEMENT OFFRANT DES CHAMBRES POUR QUE 
L'AFFICHAGE SOIT EFFECTUÉ
-->
<?php
if ($nbEtabOffrantChambres != 0) {
    ?>
    <center> <a href='?uc=attribChambres&action=demanderModifierAttrib'>
            Effectuer ou modifier les attributions</a> <br> <br>
        <?php
        // BOUCLE SUR LES ÉTABLISSEMENTS
        foreach ($lesEtabsOffrantChambres as $unEtabOffrantChambres) {
            $idEtab = $unEtabOffrantChambres['id'];
            $nomEtab = $unEtabOffrantChambres['nom'];

            ?>
            <table class='tabQuadrille' id="tabConsulterAttributionChambres">
                <!--AFFICHAGE DE LA 1ÈRE LIGNE D'EN-TÊTE-->
                <tr class='enTeteTabQuad'>
                    <td colspan='<?= $nbCol ?>'><strong><?= $nomEtab ?></strong></td>
                </tr>
                <!-- AFFICHAGE DE LA 2ÈME LIGNE D'EN-TÊTE : 1 LIT : NOMBRE DE CHAMBRES 
                DISPONIBLES, 2 À 3 LITS : NOMBRE DE CHAMBRES DISPONIBLES...-->  
                <tr class='enTete2TabQuad'>
                    <td><i>Disponibilités</i></td>
                    <?php
                    $lesTypesChambres = $pdo->obtenirReqTypesChambres();

                    // BOUCLE SUR LES TYPES DE CHAMBRES 
                    foreach ($lesTypesChambres as $unTypeChambre) {
                        $idTypeChambre = $unTypeChambre['id'];
                        $libelle = $unTypeChambre['libelle'];
                        // On recherche les disponibilités pour l'établissement et le type
                        // de chambre en question
                        $nbChDispo = $pdo->obtenirNbDispo($idEtab, $idTypeChambre);

                        ?>
                        <td><center><?= $libelle ?><br><?= $nbChDispo ?></center></td>
                    <?php
                }

                ?>
                </tr>
                <?php
                // AFFICHAGE DU DÉTAIL DES ATTRIBUTIONS : UNE LIGNE PAR GROUPE AFFECTÉ 
                // DANS L'ÉTABLISSEMENT

                if($_COOKIE['username'] == "admin")
                {
                    $lesGroupesEtab = $pdo->obtenirReqGroupesEtab($idEtab);   
                    // BOUCLE SUR LES GROUPES (CHAQUE GROUPE EST AFFICHÉ EN LIGNE)
                    foreach ($lesGroupesEtab as $unGroupeEtab) {
                        $idGroupe = $unGroupeEtab['id'];
                        $nomGroupe = $unGroupeEtab['nom'];

                        ?>
                        <tr class='ligneTabQuad'>
                            <td width='35%'>&nbsp;<?= $nomGroupe ?></td>
                            <?php
                            $lesIdTypesChambres = $pdo->obtenirReqIdTypesChambres();

                            // BOUCLE SUR LES TYPES DE CHAMBRES (CHAQUE TYPE DE CHAMBRE 
                            // FIGURE EN COLONNE)
                            foreach ($lesIdTypesChambres as $unIdTypeChambre) {
                                // On recherche si des chambres du type en question ont 
                                // déjà été attribuées à ce groupe dans l'établissement
                                $nbOccupGroupe = $pdo->obtenirNbOccupGroupe($idEtab, $unIdTypeChambre["id"], $idGroupe);

                                ?>
                                <td width='<?= $pourcCol ?>%'><center><?= $nbOccupGroupe ?></center></td>
                            <?php
                        } // Fin de la boucle sur les types de chambres

                        ?>
                        </tr>
                        <?php
                    } // Fin de la boucle sur les groupes
                }else{
                    $lesGroupesEtab = $pdo->obtenirReqGroupeEtab($idEtab,$_COOKIE['groupe']);   
                    foreach ($lesGroupesEtab as $unGroupeEtab) {
                        $idGroupe = $unGroupeEtab['id'];
                        $nomGroupe = $unGroupeEtab['nom'];
                        ?>
                        <tr class='ligneTabQuad'>
                            <td width='35%'>&nbsp;<?= $nomGroupe ?></td>
                            <?php
                            $lesIdTypesChambres = $pdo->obtenirReqIdTypesChambres();

                            // BOUCLE SUR LES TYPES DE CHAMBRES (CHAQUE TYPE DE CHAMBRE 
                            // FIGURE EN COLONNE)
                            foreach ($lesIdTypesChambres as $unIdTypeChambre) {
                                // On recherche si des chambres du type en question ont 
                                // déjà été attribuées à ce groupe dans l'établissement
                                $nbOccupGroupe = $pdo->obtenirNbOccupGroupe($idEtab, $unIdTypeChambre["id"], $idGroupe);

                                ?>
                                <td width='<?= $pourcCol ?>%'><center><?= $nbOccupGroupe ?></center></td>
                            <?php
                        } // Fin de la boucle sur les types de chambres

                        ?>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <br>
            <?php
        } // Fin de la boucle sur les établissements
    }
