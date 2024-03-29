<?php

class PdoFestival
{

    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=festival';
	private static $port = 'port=3306';
    private static $user = 'festival';
    private static $mdp = '';
    private static $monPdo;
    private static $monPdoFestival = null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
		try{
			PdoFestival::$monPdo = new PDO(
				PdoFestival::$serveur . ';' . PdoFestival::$port . ';' . PdoFestival::$bdd,
				PdoFestival::$user,
				PdoFestival::$mdp
			);
		}catch(Exception $ex)
		{
			echo $ex->getMessage();
		}
        PdoFestival::$monPdo->query('SET CHARACTER SET utf8');
    }

    /**
     * Méthode destructeur appelée dès qu'il n'y a plus de référence sur un
     * objet donné, ou dans n'importe quel ordre pendant la séquence d'arrêt.
     */
    public function __destruct()
    {
        PdoFestival::$monPdo = null;
    }

    /**
     * This method sets a description.
     *
     * @param string $description A text with a maximum of 80 characters.
     *
     * @return void
     */
    public static function getPdoFestival()
    {
        if (PdoFestival::$monPdoFestival == null) {
            PdoFestival::$monPdoFestival = new PdoFestival();
        }
        return PdoFestival::$monPdoFestival;
    }

    // FONCTIONS DE GESTION DES ÉTABLISSEMENTS

    public function obtenirReqIdNomEtablissements()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT id, nom '
            . 'FROM Etablissement '
            . 'ORDER BY id'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function obtenirReqIdNomEtablissementsOffrantChambres()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT DISTINCT id, nom '
            . 'FROM Etablissement JOIN Offre ON (id = idEtab) '
            . 'ORDER BY id'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function obtenirReqNomEtablissementsOffrantChambres()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT DISTINCT nom '
            . 'FROM Etablissement JOIN Offre ON (id = idEtab) '
            . 'ORDER BY id'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function obtenirReqIdEtablissementsOffrantChambres()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT DISTINCT id '
            . 'FROM Etablissement JOIN Offre ON (id = idEtab) '
            . 'ORDER BY id'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function obtenirDetailEtablissement($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT * '
            . 'FROM Etablissement '
            . 'WHERE id=:unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch(PDO::FETCH_OBJ);
    }

    public function supprimerEtablissement($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'DELETE FROM Etablissement '
            . 'WHERE id=:unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    public function creerModifierEtablissement($mode, $id, $nom, $adresseRue, $codePostal,
        $ville, $tel, $adresseElectronique, $type, $civiliteResponsable,
        $nomResponsable, $prenomResponsable)
    {
        if ($mode === 'C') {
            $requetePrepare = PdoFestival::$monPdo->prepare(
                'INSERT INTO Etablissement (id,nom,adresseRue,codePostal,'
                . 'ville,tel,adresseElectronique,type,civiliteResponsable,'
                . 'nomResponsable,prenomResponsable) '
                . 'VALUES (:unId, :unNom, :uneAdresseRue, :unCodePostal, '
                . ':uneVille, :unTel, :uneAdresseElectronique, :unType, '
                . ':uneCiviliteResponsable, :unNomResponsable, :unPrenomResponsable)'
            );
        } else {
            $requetePrepare = PdoFestival::$monPdo->prepare(
                'UPDATE Etablissement '
                . 'SET nom=:unNom,adresseRue=:uneAdresseRue,'
                . 'codePostal=:unCodePostal,ville=:uneVille,tel=:unTel,'
                . 'adresseElectronique=:uneAdresseElectronique,type=:unType,'
                . 'civiliteResponsable=:uneCiviliteResponsable,nomResponsable=:unNomResponsable,'
                . 'prenomResponsable=:unPrenomResponsable '
                . 'WHERE id=:unId'
            );
        }
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unNom', $nom, PDO::PARAM_STR);
        $requetePrepare->bindParam(':uneAdresseRue', $adresseRue, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unCodePostal', $codePostal, PDO::PARAM_STR);
        $requetePrepare->bindParam(':uneVille', $ville, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unTel', $tel, PDO::PARAM_STR);
        $requetePrepare->bindParam(':uneAdresseElectronique', $adresseElectronique, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unType', $type, PDO::PARAM_STR);
        $requetePrepare->bindParam(':uneCiviliteResponsable', $civiliteResponsable, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unNomResponsable', $nomResponsable, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unPrenomResponsable', $prenomResponsable, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    public function estUnIdEtablissement($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT * '
            . 'FROM Etablissement '
            . 'WHERE id=:unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }

    public function estUnNomEtablissement($mode, $id, $nom)
    {
        // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
        // on vérifie la non existence d'un autre établissement (id!='$id') portant 
        // le même nom
        if ($mode === 'C') {
            $requetePrepare = PdoFestival::$monPdo->prepare(
                'SELECT * FROM Etablissement WHERE nom=:unNom'
            );
        } else {
            $requetePrepare = PdoFestival::$monPdo->prepare(
                'SELECT * FROM Etablissement WHERE nom=:unNom AND id!=:unId'
            );
        }
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unNom', $nom, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function obtenirNbEtab()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT COUNT(*) AS nombreEtab FROM Etablissement'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetch(PDO::FETCH_OBJ)->nombreEtab;
    }

    public function obtenirNbEtabOffrantChambres()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT COUNT(DISTINCT idEtab) AS nombreEtabOffrantChambres FROM Offre'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetch(PDO::FETCH_OBJ)->nombreEtabOffrantChambres;
    }

    // FONCTIONS DE GESTION DES TYPES DE CHAMBRES

    public function obtenirReqTypesChambres()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT * FROM TypeChambre'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function obtenirReqIdTypesChambres()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT id FROM TypeChambre'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function obtenirReqLibelleTypesChambres()
    {
        $req = "SELECT libelle FROM TypeChambre ORDER BY id";
        return $req;
    }

    public function obtenirLibelleTypeChambre($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT libelle FROM TypeChambre WHERE id = :unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch(PDO::FETCH_OBJ)->libelle;
    }

    public function obtenirNbTypesChambres()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT COUNT(*) AS nombreTypesChambres FROM TypeChambre'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetch(PDO::FETCH_OBJ)->nombreTypesChambres;
    }

    public function supprimerTypeChambre($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'DELETE FROM TypeChambre WHERE id=:unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    public function obtenirDetailTypeChambre($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT * FROM TypeChambre WHERE id=:unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function creerModifierTypeChambre($mode, $id, $libelle)
    {
        if ($mode === 'C') {
            $requetePrepare = PdoFestival::$monPdo->prepare(
                'INSERT INTO TypeChambre VALUES (:unId, :unLibelle)'
            );
        } else {
            $requetePrepare = PdoFestival::$monPdo->prepare(
                'UPDATE TypeChambre SET libelle=:unLibelle WHERE id=:unId'
            );
        }
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unLibelle', $libelle, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    public function estUnIdTypeChambre($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT * FROM TypeChambre WHERE id=:unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function estUnLibelleTypeChambre($mode, $id, $libelle)
    {
        // S'il s'agit d'une création, on vérifie juste la non existence du libellé
        // sinon on vérifie la non existence d'un autre type chambre (id!='$id') 
        // ayant le même libelle
        if ($mode === 'C') {
            $requetePrepare = PdoFestival::$monPdo->prepare(
                'SELECT * FROM TypeChambre WHERE libelle=:unLibelle'
            );
        } else {
            $requetePrepare = PdoFestival::$monPdo->prepare(
                'SELECT * FROM TypeChambre WHERE libelle=:unLibelle AND id!=:unId'
            );
            $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        }
        $requetePrepare->bindParam(':unLibelle', $libelle, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    // FONCTIONS RELATIVES AUX GROUPES
    public function obtenirReqIdNomGroupesAHeberger()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT id, nom FROM Groupe WHERE hebergement=\'O\' ORDER BY id'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
    public function obtenirReqIdNomGroupeAHeberger($groupe)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT id, nom FROM Groupe WHERE hebergement=\'O\' AND nom=:groupe ORDER BY id'
        );
        $requetePrepare->bindParam(':groupe', $groupe, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    public function obtenirNomGroupe($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT nom FROM Groupe WHERE id=:unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch(PDO::FETCH_OBJ)->nom;
    }

    // FONCTIONS RELATIVES AUX OFFRES
    // Met à jour (suppression, modification ou ajout) l'offre correspondant à l'id
    // étab et à l'id type chambre transmis
    public function modifierOffreHebergement($idEtab, $idTypeChambre, $nbChambresDemandees)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT nombreChambres FROM Offre WHERE idEtab=:unIdEtab AND idTypeChambre=:unIdTypeChambre'
        );
        $requetePrepare->bindParam(':unIdEtab', $idEtab, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdTypeChambre', $idTypeChambre, PDO::PARAM_STR);
        $requetePrepare->execute();
        $res = $requetePrepare->fetch(PDO::FETCH_OBJ);
        $nbChambres = ($res) ? $res->nombreChambres : 0;
        if ($nbChambresDemandees === 0) {
            $requetePrepare = PdoFestival::$monPdo->prepare(
                'DELETE FROM Offre WHERE idEtab=:unIdEtab AND idTypeChambre=:unIdTypeChambre'
            );
        } else {
            if ($nbChambres != 0) {
                $requetePrepare = PdoFestival::$monPdo->prepare(
                    'UPDATE Offre '
                    . 'SET nombreChambres=:unNbChambresDemandees '
                    . 'WHERE idEtab=:unIdEtab AND idTypeChambre=:unIdTypeChambre'
                );
            } else {
                $requetePrepare = PdoFestival::$monPdo->prepare(
                    'INSERT INTO Offre VALUES(:unIdEtab,:unIdTypeChambre,:unNbChambresDemandees)'
                );
            }
            $requetePrepare->bindParam(':unNbChambresDemandees', $nbChambresDemandees, PDO::PARAM_STR);
        }
        $requetePrepare->bindParam(':unIdEtab', $idEtab, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdTypeChambre', $idTypeChambre, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    // Retourne le nombre de chambres offertes pour l'id étab et l'id type chambre 
    // transmis
    public function obtenirNbOffre($idEtab, $idTypeChambre)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT nombreChambres '
            . 'FROM Offre '
            . 'WHERE idEtab=:unIdEtab AND idTypeChambre=:unIdTypeChambre'
        );
        $requetePrepare->bindParam(':unIdEtab', $idEtab, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdTypeChambre', $idTypeChambre, PDO::PARAM_STR);
        $requetePrepare->execute();
        $res = $requetePrepare->fetch(PDO::FETCH_OBJ);
        return ($res) ? $res->nombreChambres : 0;
    }

    // Retourne false si le nombre de chambres transmis est inférieur au nombre de 
    // chambres occupées pour l'établissement et le type de chambre transmis 
    // Retourne true dans le cas contraire
    public function estModifOffreCorrecte($idEtab, $idTypeChambre, $nombreChambres)
    {
        $nbOccup = $this->obtenirNbOccup($idEtab, $idTypeChambre);
        return ($nombreChambres >= $nbOccup);
    }

    // FONCTIONS RELATIVES AUX ATTRIBUTIONS
    // Teste la présence d'attributions pour l'établissement transmis    
    public function existeAttributionsEtab($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT * FROM Attribution WHERE idEtab=:unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    // Teste la présence d'attributions pour le type de chambre transmis 
    public function existeAttributionsTypeChambre($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT * FROM Attribution WHERE idTypeChambre=:unId'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    // Retourne le nombre de chambres occupées pour l'id étab et l'id type chambre
    // transmis
    public function obtenirNbOccup($idEtab, $idTypeChambre)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT IFNULL(SUM(nombreChambres), 0) AS totalChambresOccup '
            . 'FROM Attribution WHERE idEtab=:unIdEtab AND idTypeChambre=:unIdTypeChambre'
        );
        $requetePrepare->bindParam(':unIdEtab', $idEtab, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdTypeChambre', $idTypeChambre, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch(PDO::FETCH_OBJ)->totalChambresOccup;
    }

    // FONCTIONS UTILISÉES UNIQUEMENT DANS LA GESTION DES ATTRIBUTIONS
    // Met à jour (suppression, modification ou ajout) l'attribution correspondant à
    // l'id étab, à l'id type chambre et à l'id groupe transmis
    public function modifierAttribChamb($idEtab, $idTypeChambre, $idGroupe, $nbChambres)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT COUNT(*) AS nombreAttribGroupe '
            . 'FROM Attribution '
            . 'WHERE idEtab=:unIdEtab '
            . 'AND idTypeChambre=:unIdTypeChambre '
            . 'AND idGroupe=:unIdGroupe'
        );
        $requetePrepare->bindParam(':unIdEtab', $idEtab, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdTypeChambre', $idTypeChambre, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdGroupe', $idGroupe, PDO::PARAM_STR);
        $requetePrepare->execute();
        $nombreAttribGroupe = $requetePrepare->fetch(PDO::FETCH_OBJ)->nombreAttribGroupe;
        if ($nbChambres === 0) {
            $requetePrepare = PdoFestival::$monPdo->prepare(
                'DELETE FROM Attribution '
                . 'WHERE idEtab=:unIdEtab '
                . 'AND idTypeChambre=:unIdTypeChambre '
                . 'AND idGroupe=:unIdGroupe'
            );
        } else {
            if ($nombreAttribGroupe != 0) {
                $requetePrepare = PdoFestival::$monPdo->prepare(
                    'UPDATE Attribution '
                    . 'SET nombreChambres=:unNbChambres '
                    . 'WHERE idEtab=:unIdEtab '
                    . 'AND idTypeChambre=:unIdTypeChambre '
                    . 'AND idGroupe=:unIdGroupe'
                );
                $requetePrepare->bindParam(':unNbChambres', $nbChambres, PDO::PARAM_INT);
            } else {
                $requetePrepare = PdoFestival::$monPdo->prepare(
                    'INSERT INTO Attribution '
                    . 'VALUES(:unIdEtab,:unIdTypeChambre,:unIdGroupe,:unNbChambres)'
                );
                $requetePrepare->bindParam(':unNbChambres', $nbChambres, PDO::PARAM_INT);
            }
        }
        $requetePrepare->bindParam(':unIdEtab', $idEtab, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdTypeChambre', $idTypeChambre, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdGroupe', $idGroupe, PDO::PARAM_STR);
        $requetePrepare->execute();
    }

    // Retourne la requête permettant d'obtenir les id et noms des groupes 
    // affectés dans l'établissement transmis
    public function obtenirReqGroupesEtab($id)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT DISTINCT id, nom '
            . 'FROM Groupe JOIN Attribution '
            . 'ON (Attribution.idGroupe=Groupe.id AND idEtab=:unId)'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    
    // Retourne la requête permettant d'obtenir l'id et le nom d'un groupe
    // affectés dans l'établissement transmis
    public function obtenirReqGroupeEtab($id, $groupe)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT DISTINCT id, nom '
            . 'FROM Groupe JOIN Attribution '
            . 'ON (Attribution.idGroupe=Groupe.id AND idEtab=:unId)'
            . 'WHERE nom =:groupe'
        );
        $requetePrepare->bindParam(':unId', $id, PDO::PARAM_STR);
        $requetePrepare->bindParam(':groupe', $groupe, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }

    // Retourne le nombre de chambres libres pour l'établissement et le type de
    // chambre en question (retournera 0 si absence d'offre ou si absence de 
    // disponibilité)  
    public function obtenirNbDispo($idEtab, $idTypeChambre)
    {
        $nbOffre = $this->obtenirNbOffre($idEtab, $idTypeChambre);
        if ($nbOffre !== 0) {
            // Recherche du nombre de chambres occupées pour l'établissement et le
            // type de chambre en question
            $nbOccup = $this->obtenirNbOccup($idEtab, $idTypeChambre);
            // Calcul du nombre de chambres libres
            $nbChLib = $nbOffre - $nbOccup;
            return $nbChLib;
        } else {
            return 0;
        }
    }

    // Retourne le nombre de chambres occupées par le groupe transmis pour l'id étab
    // et l'id type chambre transmis
    public function obtenirNbOccupGroupe($idEtab, $idTypeChambre, $idGroupe)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT nombreChambres '
            . 'FROM Attribution '
            . 'WHERE idEtab=:unIdEtab '
            . 'AND idTypeChambre=:unIdTypeChambre '
            . 'AND idGroupe=:unIdGroupe'
        );
        $requetePrepare->bindParam(':unIdEtab', $idEtab, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdTypeChambre', $idTypeChambre, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unIdGroupe', $idGroupe, PDO::PARAM_STR);
        $requetePrepare->execute();
        $res = $requetePrepare->fetch(PDO::FETCH_OBJ);
        return ($res) ? $res->nombreChambres : 0;
    }
    
    public function testLogin($username, $password)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT count(*) as nombre '
            . 'FROM groupe '
            . 'WHERE login=:username '
            . 'AND password=:password '
        );
		$password = hash('sha256',$password);
        $requetePrepare->bindParam(':username', $username, PDO::PARAM_STR);
        $requetePrepare->bindParam(':password', $password, PDO::PARAM_STR);
        $requetePrepare->execute();
        $res = $requetePrepare->fetchColumn();
        return $res;
    }
    
    public function obtenirNbGroupe()
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT count(*) as nombre '
            . 'FROM groupe'
        );
        $requetePrepare->execute();
        $res = $requetePrepare->fetchColumn();;
        return $res;
    }

    public function createAccount($nom, $identiteResponsable, $adressePostale, $nombrePersonnes, $nomPays, $hebergement, $login, $password)
    {
        //TODO
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'INSERT INTO groupe VALUES (:id, :nom, :identiteResponsable, :adressePostale, :nombrePersonnes, :nomPays, :hebergement, :login, :password)'
        );
	$password = hash('sha256',$password);
        if($this->obtenirNbGroupe() + 1 <10)
        {
            $id = "g00" .($this->obtenirNbGroupe() + 1);
        }else if($this->obtenirNbGroupe() + 1 <100){
            $id = "g0" .($this->obtenirNbGroupe() + 1);
        }else{
            $id = "g" .($this->obtenirNbGroupe() + 1);
        }
        $requetePrepare->bindParam(':id', $id, PDO::PARAM_STR);
        $requetePrepare->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requetePrepare->bindParam(':identiteResponsable', $identiteResponsable, PDO::PARAM_STR);
        $requetePrepare->bindParam(':adressePostale', $adressePostale, PDO::PARAM_STR);
        $requetePrepare->bindParam(':nombrePersonnes', $nombrePersonnes, PDO::PARAM_INT);
        $requetePrepare->bindParam(':nomPays', $nomPays, PDO::PARAM_STR);
        $requetePrepare->bindParam(':hebergement', $hebergement, PDO::PARAM_STR);
        $requetePrepare->bindParam(':login', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':password', $password, PDO::PARAM_STR);
        $requetePrepare->execute();
    }
    
    public function doesAccountAlreadyExist($username, $groupe)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT count(*) as nombre '
            . 'FROM groupe '
            . 'WHERE login=:username OR nom=:groupe'
        );
        $requetePrepare->bindParam(':username', $username, PDO::PARAM_STR);
        $requetePrepare->bindParam(':groupe', $groupe, PDO::PARAM_STR);
        $requetePrepare->execute();
        $res = $requetePrepare->fetchColumn();;
        return $res;
    }
    
    public function obtenirGroupe($username)
    {
        $requetePrepare = PdoFestival::$monPdo->prepare(
            'SELECT nom '
            . 'FROM groupe '
            . 'WHERE login=:username'
        );
        $requetePrepare->bindParam(':username', $username, PDO::PARAM_STR);
        $requetePrepare->execute();
        $res = $requetePrepare->fetchColumn();;
        return $res;
    }
}
