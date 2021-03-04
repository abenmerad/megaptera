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
		$req = "SELECT id, nom, prenom, login, poste, derniereConnexion
                FROM membre 
		        WHERE login = :login and mdp = :mdp";
		$stmt = PdoMegaptera::$monPdo->prepare($req);
		$stmt->bindParam(':login', $login); 
		$stmt->bindParam(':mdp', $mdp); 
		$stmt->execute();
		return $stmt->fetch();
	}

	public function connexion($id)
    {
        $req = "UPDATE  membre
                SET     dateInscription = NOW()
                WHERE   id = :id";
        $stmt = PdoMegaptera::$monPdo->prepare($req);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
	
	public function getLesMembres()
	{
		$req = "SELECT id, nom, prenom, login, tel, mail, poste
                FROM membre";
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
		$req = "SELECT id, nom, prenom, login, tel, mail, poste
                FROM membre 
                WHERE id=$id ";
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
	public function getUneDominanteParLibelle($libelle)
    {
        $req = "SELECT  * 
                FROM    dominante
                WHERE   libelle = :libelle";

        $stmt = PdoMegaptera::$monPdo->prepare($req);
        $stmt -> bindParam(':libelle', $libelle);
        $stmt -> execute();
        return $stmt -> fetchAll();
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
	public function inscriptionMembre($nom, $prenom, $login, $mdp, $tel, $mail, $poste)
	{
		$req = "INSERT INTO membre (nom, prenom, login, mdp, tel, mail, poste, dateInscription) 
                VALUES (:nom, :prenom, :login, :mdp, :tel, :mail, :poste, NOW())";
        $stmt = PdoMegaptera::$monPdo->prepare($req);
        $stmt -> bindParam(':nom',    $nom);
        $stmt -> bindParam(':prenom', $prenom);
        $stmt -> bindParam(':login',  $login);
        $stmt -> bindParam(':mdp',    $mdp);
        $stmt -> bindParam(':tel',    $tel);
        $stmt -> bindParam(':mail',   $mail);
        $stmt -> bindParam(':poste',  $poste);
        $stmt -> execute();
	}

	public function modifierMembre($id, $nom, $prenom, $login, $tel, $mail, $poste, $dataMembre)
	{
		$req = "UPDATE membre
                SET nom     = :nom,
                    prenom  = :prenom, 
                    login   = :login, 
                    tel     = :telephone, 
                    mail    = :courriel,
                    poste   = :poste
                WHERE id    = :id";

        $stmt = PdoMegaptera::$monPdo->prepare($req);

        if($nom == null)
            $stmt -> bindParam(':nom', $dataMembre['nom']);
        else
            $stmt -> bindParam(':nom', $nom);

        if($prenom == null)
            $stmt->bindParam(':prenom', $dataMembre['prenom']);
        else
            $stmt->bindParam(':prenom', $prenom);

        if($login == null)
            $stmt->bindParam(':login', $dataMembre['login']);
        else
            $stmt->bindParam(':login', $login);

        if($tel == null)
            $stmt->bindParam(':telephone', $dataMembre['tel']);
        else
            $stmt->bindParam(':telephone', $tel);

        if($mail == null)
            $stmt->bindParam(':courriel', $dataMembre['mail']);
        else
            $stmt->bindParam(':courriel', $mail);

        if($poste == null)
            $stmt->bindParam(':poste', $dataMembre['poste']);
        else
            $stmt->bindParam(':poste', $poste);

        $stmt->bindParam(':id', $id);
        $stmt->execute();
	}
    public function SuppressionMembre($id)
	{
		$req = "DELETE FROM membre 
                WHERE id='$id'";
		PdoMegaptera::$monPdo->exec($req);
	}

	public function getLesPostesMembres()
    {
        $req = "SELECT DISTINCT poste
                FROM membre";
        $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
    }

    /*** Vérifie l'existence d'un membre en fonction des paramètres passées et renvoie true ou false
     * @param null $id
     * @param null $nom
     * @param null $prenom
     * @param null $login
     * @param null $tel
     * @param null $mail
     */
    public function checkPresenceMembre($nom, $prenom, $login, $tel, $mail)
    {
        $nom    = (empty($nom))     ? "NULL" : $nom;
        $prenom = (empty($prenom))  ? "NULL" : $prenom;
        $login  = (empty($login))   ? "NULL" : $login;
        $tel    = (empty($tel))     ? "NULL" : $tel;
        $mail   = (empty($mail))    ? "NULL" : $mail;

        $req    =  "SELECT  id, nom, prenom, login, tel, mail
                    FROM    membre
                    WHERE   nom     = :nom
                    OR      prenom  = :prenom
                    OR      login   = :login
                    OR      tel     = :tel
                    OR      mail    = :mail";

        $stmt = PdoMegaptera::$monPdo->prepare($req);

        $stmt -> bindParam(':nom', $nom);
        $stmt -> bindParam(':prenom', $prenom);
        $stmt -> bindParam(':login', $login);
        $stmt -> bindParam(':tel', $tel);
        $stmt -> bindParam(':mail', $mail);

        $stmt -> execute();
        return $stmt->fetchAll();
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
	{   $req = "SELECT membre.nom, membre.prenom, codeObservation, lieuObservation, autreLieu, nomPhoto, heureDebutObservation, heureFinObservation, dateObservation, latitude, longitude, nbIndividus, papillon, typeCaudale, commentaire, comportement, typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu,orientationLat,orientationLong, nom, dateMAJ
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
		$req="DELETE 
              FROM observation 
              WHERE codeObservation='$code'";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function ajouterLieu($code,$lieu,$latitude,$longitude)
	{
		$req = "INSERT INTO lieu 
                VALUES ('$code','$lieu','$latitude','$longitude')";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function modifierLieu($code, $nouveauCode, $lieu, $latitude, $longitude)
	{
		$req="UPDATE lieu 
              SET code              = '$nouveauCode',
                  lieu              = '$lieu', 
                  orientationLat    = '$latitude', 
                  orientationLong   = '$longitude'
              WHERE code            = '$code'";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function verifierLieu($code)
    {
        $req = "SELECT code
                FROM lieu
                WHERE code = '$code'";
        $res = PdoMegaptera::$monPdo->query($req);
        return $res->rowCount();
    }
	public function supprimerLieu($code)
	{
		$req="delete from Lieu WHERE code='$code'";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function getObservationLieu()
	{
		$req = "SELECT * 
                FROM lieu 
                WHERE code NOT IN(SELECT lieu
                                  FROM observation)";
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
	{
		$req = "INSERT INTO dominante(libelle) 
                VALUES(:libelle)";
        $stmt = PdoMegaptera::$monPdo -> prepare($req);
        $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
        $stmt->execute();
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
    public function ajouterGroupe($code, $libelle, $operateur, $valeur)
	{
		$req = "INSERT INTO typegroupe 
                VALUES (:code, :libelle, :operateur, :valeur)";
        $stmt = PdoMegaptera::$monPdo -> prepare($req);
        $stmt->bindParam(':code',           $code,   PDO::PARAM_STR);
        $stmt->bindParam(':libelle',        $libelle,       PDO::PARAM_STR);
        $stmt->bindParam(':operateur',      $operateur,     PDO::PARAM_STR_CHAR);
        $stmt->bindParam(':valeur',         $valeur,        PDO::PARAM_INT);
        $stmt->execute();
	}
    public function modifierGroupe($code, $nouveauCode, $libelle, $operateur, $valeur)
	{
		$req = "UPDATE  typegroupe
                SET     code        = :nouveauCode,
                        libelle     = :libelle,
                        operateur   = :operateur,
                        valeur      = :valeur
                WHERE   code        = :code";

        $stmt = PdoMegaptera::$monPdo -> prepare($req);
        $stmt->bindParam(':nouveauCode',    $nouveauCode,   PDO::PARAM_STR);
        $stmt->bindParam(':libelle',        $libelle,       PDO::PARAM_STR);
        $stmt->bindParam(':operateur',      $operateur,     PDO::PARAM_STR_CHAR);
        $stmt->bindParam(':valeur',         $valeur,        PDO::PARAM_INT);
        $stmt->bindParam(':code',           $code,          PDO::PARAM_STR);
        $stmt->execute();
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
		$req ="SELECT  max(codeObservation) as Max 
               FROM observation
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
		{
		    $WHERE = 1;
			$req .= " WHERE lieuObservation = '$lieu' ";
		}
		if ($annee !="NULL")
		{
		    if ($WHERE == 1)
	        {
				$req .= " and";
			}
			else
			{
			    $WHERE = 1;
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
        $req = "SELECT          dateMAJ, dateDeValidite, membre.nom as nomMembre, membre.prenom as prenomMembre, etatObservation, lieuObservation, codeObservation, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude, longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu, orientationLat,orientationLong 
                FROM            observation 
                INNER JOIN      typegroupe 
                ON              typegroupe.code              = typeGroupeObserve 
                INNER JOIN      dominante 
                ON              id                           = dominante 
                INNER JOIN      lieu 
                ON              lieu.code                    = lieuObservation
                INNER JOIN      membre
                ON              membre.id                    = auteurObservation";
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
    public function getLesObservationsParLieu($codeLieu)
    {
        $req = "SELECT *
                FROM observation
                WHERE lieuObservation = '$codeLieu'";
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

    public function getLesObservationsParMembre($idMembre)
    {
        $req    = "SELECT *
                   FROM observation
                   WHERE auteurObservation = :id";
        $stmt = PdoMegaptera::$monPdo->prepare($req);
        $stmt -> bindParam(':id', $idMembre);
        $stmt -> execute();
        return $stmt->fetchAll();
    }

    public function getLesObservationsParGroupe($codeGrp)
    {
        $req    =   "SELECT *
                    FROM observation
                    WHERE typeGroupeObserve = :code";
        $stmt   = PdoMegaptera::$monPdo->prepare($req);
        $stmt -> bindParam(':code', $codeGrp);
        $stmt -> execute();
        return $stmt->fetchAll();
    }

    public function getLesObservationsParDominante($idDom)
    {
        $req    =   "SELECT codeObservation
                     FROM   observation
                     WHERE  dominante = :idDominante";
        $stmt   = PdoMegaptera::$monPdo->prepare($req);
        $stmt -> bindParam(':idDominante', $idDom, PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt->fetchAll();
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
    public function modifierObservation($code, $lieu, $latitude, $longitude, $nouvCode, $nouvNomPhoto)
    {
        $req = "UPDATE  observation
                SET     lieuObservation =   '$lieu', 
                        latitude =          '$latitude', 
                        longitude =         '$longitude', 
                        codeObservation =   '$nouvCode', 
                        nomPhoto =          '$nouvNomPhoto'
                WHERE   codeObservation =   '$code'";
        PdoMegaptera::$monPdo->query($req);
    }
}