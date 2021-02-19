<?php
class PdoMegaptera
{
	private static $serveur='mysql:host=localhost';
	private static $bdd='dbname=megaptera';
	private static $user='root';
	private static $mdp='';
	private static $monPdo;
	private static $monPdoMegaptera = null;
	
	/* La fonction __construct  */
	private function __construct()
	{
		PdoMegaptera::$monPdo = new PDO(PdoMegaptera::$serveur.';'.PdoMegaptera::$bdd, PdoMegaptera::$user, PdoMegaptera::$mdp);
		PdoMegaptera::$monPdo->query("SET CHARACTER SET utf8");
		PdoMegaptera::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        PdoMegaptera::$monPdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        PdoMegaptera::$monPdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
	}

	/* La fonction __destruction  */
	public function __destruction(){
		PdoMegaptera::$monPdo = null;
	}

	/* La fonction getPdo  */
	public static function getPdoMegaptera()
	{
		if(PdoMegaptera::$monPdoMegaptera == null)
		{
			PdoMegaptera::$monPdoMegaptera = new PdoMegaptera();
		}
		return PdoMegaptera::$monPdoMegaptera;
	}

	// rechercher si membre
	public function getInfosMembre($login,$mdp)
	{
		$req = "SELECT id, nom, prenom, login, poste 
                FROM membre 
		        WHERE login = :login and mdp = :mdp";
		$stmt = PdoMegaptera::$monPdo->prepare($req);
		$stmt->bindParam(':login', $login); 
		$stmt->bindParam(':mdp', $mdp); 
		$stmt->execute();
		return $stmt->fetch();
	}
	
	public function getLesMembres()
	{
		$req = "SELECT * 
                FROM membre ";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}
	public function getLesMembresAdmin()
	{
		$req = "SELECT * 
                FROM membre 
                WHERE poste = 'membre'";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}

	public function getUnMembre($id)
	{
		$req = "SELECT * FROM membre WHERE id=$id ";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetch();
	}

    /****
     * @param $mail
     */
	public function getUnMembreParMail($mail)
    {
        $req = "SELECT * 
                FROM membre 
                WHERE mail = '$mail'";
        $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
    }
	/* La fonction getLieu sert a récuperer les différents lieu dans la BDD*/
	public function getLesLieux()
	{
		$req = "SELECT * 
                FROM lieu;";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}
	
		public function getUnLieu($code)
	{
		$req = "SELECT * 
                FROM lieu 
                WHERE code = '$code'";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetch();
	}
	
	public function getLesDominantes()
	{
		$req = "SELECT * 
                FROM dominante";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}

	public function getUneDominante($id)
	{
		$req = "SELECT * 
                FROM dominante 
                WHERE id = $id";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetch();
	}
	
	public function getLesGroupes()
	{
		$req = "SELECT * 
                FROM typegroupe;";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}
	
	public function getUnGroupe($code)
	{
		$req = "SELECT * 
                FROM typegroupe 
                WHERE code = '$code'";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetch();
	}
	public function getTypeCaudale()
	{
		$req = "SELECT * 
                FROM typecaudale";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}

	/* La fonction inscription sert a integrer les infos entrées par l'utilisateur dans la BDD  */
	public function inscriptionMembre($nom,$prenom,$login,$mdp,$tel,$mail,$poste)
	{
		$req = "INSERT INTO membre (nom, prenom, login, mdp, tel, mail, poste) 
                VALUES ('$nom', '$prenom', '$login', '$mdp', '$tel', '$mail', '$poste')";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function modifierMembre($id,$prenom,$login,$mdp,$tel,$mail)
	{
		$req = "UPDATE membre 
                SET prenom = '$prenom', login='$login', mdp= '$mdp', tel= '$tel', mail = '$mail' 
                WHERE id='$id'";
		PdoMegaptera::$monPdo->exec($req);
	}
    public function SuppressionMembre($id)
	{
		$req = "DELETE FROM membre 
                WHERE id='$id'";
		PdoMegaptera::$monPdo->exec($req);
	}
	
	public function getObservationMembres()
	{
		$req = "SELECT * 
                FROM membre 
                WHERE id NOT IN (SELECT auteurObservation
		                         FROM observation)
                                 UNION
				                 SELECT * 
                                 FROM membre 
                                 WHERE id NOT IN (SELECT numAdministrateur 
                                                  FROM observation)";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}

	public function getObservationGroupe()
	{
		$req = "SELECT * 
                FROM typegroupe 
                WHERE code NOT IN (SELECT typeGroupeObserve
		                           FROM observation)";
				
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}
	
	public function getObservationNonValide()
	{   $req = "SELECT codeObservation,lieuObservation,autreLieu, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu,orientationLat,orientationLong,nom 
	            FROM observation 
                INNER JOIN typegroupe 
                ON typegroupe.code = typeGroupeObserve 
                INNER JOIN dominante 
                ON id = dominante 
                INNER JOIN lieu 
                ON lieu.code = lieuObservation 
                INNER JOIN membre 
                ON membre.id=auteurObservation 
				WHERE etatObservation = 'TR'";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}
	
	public function supprimerObservation($code)
	{
		$req="delete from observation WHERE codeObservation='$code'";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function ajouterLieu($code,$lieu,$latitude,$longitude)
	{
		$req = "INSERT INTO lieu VALUES ('$code','$lieu','$latitude','$longitude')";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function modifierLieu($code,$lieu,$latitude,$longitude)
	{
		$req="update lieu set lieu = '$lieu' , orientationLat = '$latitude', orientationLong = '$longitude' WHERE code='$code'";
		PdoMegaptera::$monPdo->exec($req);
	}	
	public function supprimerLieu($code)
	{
		$req="delete from Lieu WHERE code='$code'";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function getObservationLieu()
	{
		$req = "SELECT * FROM lieu WHERE code not in(select lieu
		                                               from observation)";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}
	public function getObservationDominante()
	{
		$req = "SELECT * FROM dominante WHERE id not in(select dominante
		                                               from observation)";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}
	public function ajouterDominante($libelle)
	{   $req="select max(id) as code from dominante";
		$res = PdoMegaptera::$monPdo->query($req);
		$uneLigne = $res->fetch();
		$id=$uneLigne['code'] + 1;
		var_dump($id);
		$req = "INSERT INTO dominante(id,libelle) VALUES($id,'$libelle')";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function modifierDominante($id,$libelle)
	{  
		$req = "update dominante set libelle = '$libelle' WHERE id = $id";
		PdoMegaptera::$monPdo->exec($req);
	}

	public function supprimerDominante($id)
	{
		$req="delete from dominante WHERE id=$id";
		PdoMegaptera::$monPdo->exec($req);
	}
    public function ajouterGroupe($code,$libelle,$operateur,$valeur)
	{
		$req = "INSERT INTO typegroupe VALUES ('$code','$libelle','$operateur',$valeur)";
		PdoMegaptera::$monPdo->exec($req);
	}
    public function modifierGroupe($code,$libelle,$operateur,$valeur)
	{
		$req = "UPDATE typegroupe 
                SET libelle = '$libelle', operateur = '$operateur' , valeur = $valeur 
                WHERE code = '$code'";
		PdoMegaptera::$monPdo->exec($req);
	}

	public function supprimerGroupe($code)
	{
		$req="DELETE FROM typegroupe 
              WHERE code='$code'";
		PdoMegaptera::$monPdo->exec($req);
	}

	public function dernierEnregistrementObs()
	{
		$req = "SELECT * 
                FROM `observation` 
                WHERE codeObservation = (SELECT MAX(codeObservation) 
                                         FROM `observation`);";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetch();
	}
	public function dernierCodeObs($code)
	{
		$req ="SELECT max(codeObservation) as Max 
               FROM `observation` 
               WHERE codeObservation LIKE '$code%'";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetch();
	}

	public function ajouterObservation($code,$photo, $lieu, $autreLieu, $heureDeb, $heureFin, $dateObs, $latitude, $longitude, $auteurObs, $dominante,$papillon, $nbInd, $caudale, $groupe, $com, $comp)
	{
		try
		{
			$req = "INSERT INTO observation(codeObservation, nomPhoto, lieuObservation, autreLieu, heureDebutObservation, heureFinObservation, dateObservation, latitude, longitude, auteurObservation, dominante, papillon, nbIndividus, typeCaudale, TypeGroupeObserve, commentaire, comportement,dateEnregistrement, dateMAJ) 
            VALUES ('$code', '$photo', '$lieu', :lieuAutre, '$heureDeb', '$heureFin', '$dateObs', '$latitude', '$longitude', '$auteurObs', '$dominante','$papillon', $nbInd, $caudale, '$groupe', :commentaire, :comportement, NOW(), NOW())";
            $stmt = PdoMegaptera::$monPdo->prepare($req);
            $stmt->bindParam(':lieuAutre', $autreLieu);
            $stmt->bindParam(':commentaire', $com);
            $stmt->bindParam(':comportement', $comp);
            $stmt->execute();
		}
		catch(Exception $e)
		{
			die('Erreur' . $e);
		}
	}

	public function MajObservation($repertoireDestination,$code,$lieu,$comme,$anne,$domi,$cauda,$papi,$ID,$heureDebut,$heureFin,$auteur,$TG,$NBi,$comp,$latitude,$longitude)
	{
		$req = "UPDATE INTO 
		        photo(Photo_caudale, Code, Lieu, Commentaires, Année, Dominant, TypeCaudale, Papillon, ID, DateEnregistrement, HeureDebut, HeureFin, Auteur, TypeGroupe, NbrIndividu, Comportement, Latitude, Longitude) 
		        VALUES ('$repertoireDestination','$code','$lieu','$comme','$anne','$domi','$cauda','$papi','$ID',NOW(),'$heureDebut','$heureFin','$auteur','$TG','$NBi','$comp','$latitude','$longitude')";
		PdoMegaptera::$monPdo->query($req);
	}
	public function getLesAnnees()
	{
		$req = "SELECT DISTINCT(year(dateObservation)) as annee from observation";
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	public function getRechercheObservation($lieu,$annee,$dominante,$groupe)
	{
		$req = "SELECT codeObservation, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu,orientationLat,orientationLong,nom FROM observation INNER JOIN typegroupe ON typegroupe.code = typeGroupeObserve INNER JOIN dominante ON id = dominante INNER JOIN lieu ON lieu.code = lieuObservation INNER JOIN membre ON membre.id=auteurObservation";
		$WHERE = 0;
		
		if ($lieu !="NULL")
		{   $WHERE = 1;
			$req .= " WHERE lieuObservation = '$lieu' ";
			
		}
		if ($annee !="NULL")
		{   if ($WHERE == 1)
	        {
				$req .= " and";
			}
			else
			{   $WHERE = 1;
		        $req .= " WHERE";
			}
			$req .=  " year(dateObservation) = $annee";
		}
		
		if ($dominante !="NULL")
		{    if ($WHERE == 1)
	        {
				$req .= " and";
			}
			else
			{   $WHERE = 1;
		        $req .= " WHERE";
			}
			
			$req .= " dominante = $dominante";
		}
		if ($groupe !="NULL")
		{    if ($WHERE == 1)
	        {
				$req .= " and";
			}
			else
			{   $WHERE = 1;
		        $req .= " WHERE";
			}
			
			$req .=  " typeGroupeObserve = '$groupe'";
		}
		if ($WHERE == 1)
	    {
				$req .= " and";
		}
		else
		{
		        $WHERE = 1;
		        $req .=  " WHERE";
		}
		$req .= " dateDeValidite is not null";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}
	public function getUneObservation($id)
	{
		$req = "SELECT codeObservation, nomPhoto, typegroupe.libelle as Groupe,dominante.libelle as Dominante,lieu.lieu as Lieu, lieu.code as CodeLieu, heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement 
                FROM observation 
                INNER JOIN typegroupe 
                ON typegroupe.code = typeGroupeObserve 
                INNER JOIN dominante 
                ON id = dominante 
                INNER JOIN lieu 
                ON lieu.code = lieuObservation";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetch();
	}
    public function getLesObservationsAExporte($idMembre, $annee, $groupe, $lieu, $couleur, $caudale, $papillon, $min, $max)
    {
        $req = "SELECT codeObservation, typegroupe.libelle as Groupe,dominante.libelle as Dominante,lieu.lieu as Lieu, heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement 
                FROM observation 
                INNER JOIN typegroupe 
                ON typegroupe.code          = typeGroupeObserve 
                INNER JOIN dominante 
                ON id                       = dominante 
                INNER JOIN lieu 
                ON lieu.code                = lieuObservation 
                WHERE auteurObservation     = '$idMembre'
                AND etatObservation         = 'VA'
                AND nbIndividus             >= '$min' 
                AND nbIndividus             <= '$max'";

        if(!empty($annee))
            $req .= " AND dateObservation LIKE '$annee%'";

        if(!empty($groupe))
            $req .= " AND typeGroupeObserve = '$groupe'";

        if(!empty($lieu))
            $req .= " AND lieuObservation = '$lieu'";

        if(!empty($couleur))
            $req .= " AND dominante = '$couleur'";

        if(!empty($caudale))
            $req .= " AND typeCaudale = '$caudale'";

        if(!empty($papillon))
            $req .= " AND papillon = '$papillon'";


        $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
    }
	public function getLesObservationsParFiltre($idMembre, $annee, $groupe, $lieu, $couleur, $caudale, $papillon, $min, $max)
    {
        $req = "SELECT          dateMAJ, dateDeValidite, membre.nom as nomMembre, membre.prenom as prenomMembre, etatObservation, lieuObservation, codeObservation, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude, longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu, orientationLat,orientationLong 
                FROM            observation 
                INNER JOIN      typegroupe 
                ON              typegroupe.code              = typeGroupeObserve 
                INNER JOIN      dominante 
                ON              id                           = dominante 
                INNER JOIN      lieu 
                ON              lieu.code                    = lieuObservation
                INNER JOIN      membre
                ON              membre.id                    = auteurObservation
                WHERE           etatObservation = 'VA'
                AND             nbIndividus                 >= '$min' 
                AND             nbIndividus                 <= '$max'";

        if(!empty($annee))
            $req .= " AND dateObservation LIKE '$annee%'";

        if(!empty($groupe))
            $req .= " AND typeGroupeObserve = '$groupe'";

        if(!empty($lieu))
            $req .= " AND lieuObservation = '$lieu'";

        if(!empty($couleur))
            $req .= " AND dominante = '$couleur'";

        if(!empty($caudale))
            $req .= " AND typeCaudale = '$caudale'";

        if(!empty($papillon))
            $req .= " AND papillon = '$papillon'";


        $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
    }

    public function getLesEtatsObservation()
    {
        $req = "SELECT * 
                FROM etatobservation";
        $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
    }

	public function getUneObservationNonValide()
    {
        $req = "SELECT codeObservation, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu, orientationLat,orientationLong 
                FROM observation 
                INNER JOIN typegroupe 
                ON typegroupe.code = typeGroupeObserve 
                INNER JOIN dominante 
                ON id = dominante 
                INNER JOIN lieu 
                ON lieu.code = lieuObservation 
                WHERE etatObservation = 'TR' ";
        $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
    }
    public function validerUneObservation($code)
    {
        $req = "UPDATE observation 
                SET etatObservation = 'VA', dateDeValidite = CURRENT_DATE 
                WHERE codeObservation = '$code'";
        PdoMegaptera::$monPdo->exec($req);
    }

    public function getLesObservations()
    {
        $req = "SELECT codeObservation, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu, orientationLat,orientationLong 
                FROM observation 
                INNER JOIN typegroupe 
                ON typegroupe.code = typeGroupeObserve";
        $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
    }

    public function getObservationMembre($id)
    {
	    $req = "SELECT count(codeObservation)
	            FROM observation
	            WHERE '$id' = auteurObservation";
	    $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetch();
    }
    public function getLesMembresNonAdmin()
    {
        $req = "SELECT * 
                FROM membre 
                WHERE poste ='membre'";
        $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
    }

    public function modifMembre($id, $nom, $prenom, $tel, $mail, $login, $mdp, $poste)
    {
        $req = "UPDATE membre
                SET nom = '$nom', prenom = '$prenom', tel = '$tel', login = '$login', mdp = '$mdp', poste = '$poste'
                WHERE id = '$id'";
        PdoMegaptera::$monPdo->exec($req);
    }
}