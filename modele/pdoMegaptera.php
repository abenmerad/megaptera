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
		$req = "SELECT * FROM membre 
		WHERE login = ':login' and mdp = ':mdp'";

		$stmt = PdoMegaptera::$monPdo->prepare($req);
		$stmt->bindParam(':login', $login); 
		$stmt->bindParam(':mdp', $mdp); 
		$stmt->execute();
		$laligne = $stmt->fetch();
		
        $res = PdoMegaptera::$monPdo->query($req);
		return $res->fetch();
	}
	
	public function getLesMembres()
	{
		$req = "SELECT * FROM membre ";
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	public function getLesMembresAdmin()
	{
		$req = "SELECT * FROM membre where poste = 'membre'";
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function getUnMembre($id)
	{
		$req = "SELECT * FROM membre where id=$id ";
		$res = PdoMegaptera::$monPdo->query($req);
		$unMembre= $res->fetch();
		return $unMembre;
	}
	
	/* La fonction getLieu sert a récuperer les différents lieu dans la BDD*/
	public function getLesLieux()
	{
		$req = "SELECT * FROM lieu;";
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
		public function getUnLieu($code)
	{
		$req = "SELECT * FROM lieu where code = '$code'";
		$res = PdoMegaptera::$monPdo->query($req);
		$uneLigne = $res->fetch();
		return $uneLigne;
	}
	
	public function getLesDominantes()
	{
		$req = "SELECT * FROM dominante";
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
		public function getUneDominante($id)
	{
		$req = "SELECT * FROM dominante where id = $id";
		$res = PdoMegaptera::$monPdo->query($req);
		$uneLigne = $res->fetch();
		return $uneLigne;
	}
	
	public function getLesGroupes()
	{
		$req = "SELECT * FROM typegroupe;";
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	public function getUnGroupe($code)
	{
		$req = "SELECT * FROM typegroupe where code = '$code'";
		$res = PdoMegaptera::$monPdo->query($req);
		$uneLigne = $res->fetch();
		return $uneLigne;
	}
	public function getTypeCaudale()
	{
		$req = "SELECT * FROM typecaudale";
		$res = PdoMegaptera::$monPdo->query($req);
		$uneLigne = $res->fetchAll();
		return $uneLigne;
	}
	public function getPapillon()
	{
		$req = "SELECT * FROM typecaudale";
		$res = PdoMegaptera::$monPdo->query($req);
		$uneLigne = $res->fetchAll();
		return $uneLigne;
	}
	/* La fonction inscription sert a integrer les infos entrer par l'utilisateur dans la BDD  */
	public function inscriptionMembre($nom,$prenom,$login,$mdp,$tel,$mail,$poste)
	{
		$req = "INSERT INTO membre (nom, prenom, login, mdp, tel, mail, poste) VALUES ('$nom', '$prenom', '$login', '$mdp', '$tel', '$mail', '$poste')";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function modifierMembre($id,$prenom,$login,$mdp,$tel,$mail)
	{
		$req = "update membre set prenom = '$prenom', login='$login', mdp= '$mdp', tel= '$tel', mail = '$mail' where id=$id";
		PdoMegaptera::$monPdo->exec($req);
	}
    public function SuppressionMembre($id)
	{
		$req = "delete from membre where id=$id";
		PdoMegaptera::$monPdo->exec($req);
	}
	
	public function getObservationMembres()
	{
		$req = "SELECT * FROM membre where id not in(select auteurObservation
		                                               from observation)
				union
				select * from membre where id not in(select numAdministrateur from observation)";
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	
	public function getObservationGroupe()
	{
		$req = "SELECT * FROM typegroupe where code not in(select typeGroupeObserve
		                                               from observation)";
				
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	public function getObservationNonValide()
	{   $req = "SELECT codeObservation,lieuObservation,autreLieu, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu,orientationLat,orientationLong,nom 
	            FROM observation inner join typegroupe on typegroupe.code = typeGroupeObserve inner join dominante on id = dominante inner join lieu on lieu.code = lieuObservation inner join membre on membre.id=auteurObservation 
				where dateDeValidite is null";

		
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	public function supprimerObservation($code)
	{
		$req="delete from observation where code='$code'";
		PdoMegaptera::$monPdo->exec($req);
		$req="delete from observation where codeObservation='$code'";
		var_dump($req);
		$res = PdoMegaptera::$monPdo->exec($req);
	}
	public function ajouterLieu($code,$lieu,$latitude,$longitude)
	{
		$req = "INSERT INTO lieu VALUES ('$code','$lieu','$latitude','$longitude')";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function modifierLieu($code,$lieu,$latitude,$longitude)
	{
		$req="update lieu set lieu = '$lieu' , orientationLat = '$latitude', orientationLong = '$longitude' where code='$code'";
		PdoMegaptera::$monPdo->exec($req);
	}	
	public function supprimerLieu($code)
	{
		$req="delete from Lieu where code='$code'";
		PdoMegaptera::$monPdo->exec($req);
	}
	public function getObservationLieu()
	{
		$req = "SELECT * FROM lieu where code not in(select lieu
		                                               from observation)";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
	}
	public function getObservationDominante()
	{
		$req = "SELECT * FROM dominante where id not in(select dominante
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
		$req = "update dominante set libelle = '$libelle' where id = $id";
		PdoMegaptera::$monPdo->exec($req);
	}

	public function supprimerDominante($id)
	{
		$req="delete from dominante where id=$id";
		PdoMegaptera::$monPdo->exec($req);
	}
    public function ajouterGroupe($code,$libelle,$operateur,$valeur)
	{
		$req = "INSERT INTO typegroupe VALUES ('$code','$libelle','$operateur',$valeur)";
		PdoMegaptera::$monPdo->exec($req);
	}
    public function modifierGroupe($code,$libelle,$operateur,$valeur)
	{
		$req = "update typegroupe set libelle = '$libelle', operateur = '$operateur' , valeur = $valeur where code = '$code'";
		PdoMegaptera::$monPdo->exec($req);
	}

	public function supprimerGroupe($code)
	{
		$req="delete from typegroupe where code='$code'";
		PdoMegaptera::$monPdo->exec($req);
	}

	public function dernierEnregistrementObs()
	{
		$req = "SELECT * FROM `observation` WHERE codeObservation = (SELECT MAX(codeObservation) FROM `observation`);";
		$res = PdoMegaptera::$monPdo->query($req);
		$dernier = $res->fetch();
		return $dernier;
	}
	public function dernierCodeObs($code)
	{
		$req ="SELECT max(codeObservation) as Max FROM `observation` WHERE codeObservation like'$code%'";
		$res = PdoMegaptera::$monPdo->query($req);
		$dernier = $res->fetch();
		return $dernier;
	}

	public function ajouterObservation($code,$photo, $lieu, $autreLieu, $heureDeb, $heureFin, $dateObs, $latitude, $longitude, $auteurObs, $dominante,$papillon, $nbInd, $caudale, $groupe, $com, $comp)
	{
	    $ok = true;
		try
		{
			$req = "INSERT INTO observation(codeObservation, nomPhoto, lieuObservation, autreLieu, heureDebutObservation, heureFinObservation, dateObservation, latitude, longitude, auteurObservation, dominante, papillon, nbIndividus, typeCaudale, TypeGroupeObserve, commentaire, comportement,dateEnregistrement, dateMAJ) VALUES ('$code', '$photo', '$lieu','$autreLieu', '$heureDeb', '$heureFin', '$dateObs', '$latitude', '$longitude', '$auteurObs', '$dominante','$papillon', $nbInd, $caudale, '$groupe','$com','$comp', NOW(), NOW())";
			PdoMegaptera::$monPdo->exec($req);
		}
		catch(Exception $e)
		{
			die('Erreur' . $e);
			$ok = false;
		}
		return $ok;
	}

	public function MajObservation($repertoireDestination,$code,$lieu,$comme,$anne,$domi,$cauda,$papi,$ID,$heureDebut,$heureFin,$auteur,$TG,$NBi,$comp,$latitude,$longitude)
	{
		$req = "update  INTO photo(Photo_caudale, Code, Lieu, Commentaires, Année, Dominant, TypeCaudale, Papillon, ID, DateEnregistrement, HeureDebut, HeureFin, Auteur, TypeGroupe, NbrIndividu, Comportement, Latitude, Longitude) VALUES ('$repertoireDestination','$code','$lieu','$comme','$anne','$domi','$cauda','$papi','$ID',NOW(),'$heureDebut','$heureFin','$auteur','$TG','$NBi','$comp','$latitude','$longitude')";
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
		$req = "SELECT codeObservation, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu,orientationLat,orientationLong,nom FROM observation inner join typegroupe on typegroupe.code = typeGroupeObserve inner join dominante on id = dominante inner join lieu on lieu.code = lieuObservation inner join membre on membre.id=auteurObservation";
		$where = 0;
		
		if ($lieu !="NULL")
		{   $where = 1;
			$req .= " where lieuObservation = '$lieu' ";
			
		}
		if ($annee !="NULL")
		{   if ($where == 1)
	        {
				$req .= " and";
			}
			else
			{   $where = 1;
		        $req .= " where";    
			}
			$req .=  " year(dateObservation) = $annee";
		}
		
		if ($dominante !="NULL")
		{    if ($where == 1)
	        {
				$req .= " and";
			}
			else
			{   $where = 1;
		        $req .= " where";    
			}
			
			$req .= " dominante = $dominante";
		}
		if ($groupe !="NULL")
		{    if ($where == 1)
	        {
				$req .= " and";
			}
			else
			{   $where = 1;
		        $req .= " where";    
			}
			
			$req .=  " typeGroupeObserve = '$groupe'";
		}
		if ($where == 1)
	    {
				$req .= " and";
		}
		else
		{
		        $where = 1;
		        $req .=  " where";    
		}
			
		$req .= " dateDeValidite is not null";
	
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	public function getUneObservation($id)
	{
		$req = "SELECT codeObservation, nomPhoto, typegroupe.libelle as Groupe,dominante.libelle as Dominante,lieu.lieu as Lieu, lieu.code as CodeLieu, heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement FROM observation inner join typegroupe on typegroupe.code = typeGroupeObserve inner join dominante on id = dominante inner join lieu on lieu.code = lieuObservation";
		$res = PdoMegaptera::$monPdo->query($req);
        return $res->fetch();
	}
    public function getLesObservationsAExporte($idMembre, $annee, $etat, $groupe, $lieu)
    {
        $req = "SELECT codeObservation, typegroupe.libelle as Groupe,dominante.libelle as Dominante,lieu.lieu as Lieu, heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement FROM observation inner join typegroupe on typegroupe.code = typeGroupeObserve inner join dominante on id = dominante inner join lieu on lieu.code = lieuObservation WHERE auteurObservation = '$idMembre'";
        if(!empty($annee))
            $req .= " AND dateObservation LIKE '$annee%'";

        if(!empty($etat))
            $req .= " AND etatObservation = '$etat'";

        if(!empty($groupe))
            $req .= " AND typeGroupeObserve = '$groupe'";

        if(!empty($lieu))
            $req .= " AND lieuObservation = '$lieu'";

        $res = PdoMegaptera::$monPdo->query($req);
        return $res-fetchAll();
    }
	public function getLesObservationsParFiltre($idMembre, $annee, $etat, $groupe, $lieu)
    {
        $req = "SELECT etatObservation, lieuObservation, codeObservation, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu, orientationLat,orientationLong FROM observation inner join typegroupe on typegroupe.code = typeGroupeObserve inner join dominante on id = dominante inner join lieu on lieu.code = lieuObservation WHERE auteurObservation = '$idMembre'";

        if(!empty($annee))
            $req .= " AND dateObservation LIKE '$annee%'";

        if(!empty($etat))
            $req .= " AND etatObservation = '$etat'";

        if(!empty($groupe))
            $req .= " AND typeGroupeObserve = '$groupe'";

        if(!empty($lieu))
            $req .= " AND lieuObservation = '$lieu'";

        $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
    }

    public function getLesEtatsObservation()
    {
        $req = "SELECT * FROM etatobservation";
        $res = PdoMegaptera::$monPdo->query($req);
        return $res->fetchAll();
    }

	public function getUneObservationNonValide()
    {
        $req = "SELECT codeObservation, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu, orientationLat,orientationLong 
                FROM observation inner join typegroupe on typegroupe.code = typeGroupeObserve 
                inner join dominante on id = dominante 
                inner join lieu on lieu.code = lieuObservation 
                where etatObservation = 'TR' ";
        $res = PdoMegaptera::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public function validerUneObservation($code)
    {
        $req = "UPDATE observation SET etatObservation = 'VA', dateDeValidite = CURRENT_DATE WHERE codeObservation = '$code'";
        var_dump($req);
        $res = PdoMegaptera::$monPdo->query($req);
    }

    public function getLesObservations()
    {
        $req = "SELECT codeObservation, nomPhoto,heureDebutObservation,heureFinObservation,dateObservation, latitude,longitude,nbIndividus,papillon,typeCaudale,commentaire,comportement,typegroupe.libelle as libGroupe,dominante.libelle as libDominante,lieu.lieu as libLieu, orientationLat,orientationLong 
                FROM observation inner join typegroupe on typegroupe.code = typeGroupeObserve";
        $res = PdoMegaptera::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    public function getObservationMembre($id)
    {
	    $req = "SELECT count(codeObservation)
	            FROM observation
	            where '$id' = auteurObservation";
	    $res = PdoMegaptera::$monPdo->query($req);
	    $lesLignes = $res->fetch();
	    return $lesLignes;
    }
    public function getLesMembresNonAdmin()
    {
        $req = "SELECT * FROM membre where poste ='membre'";
        $res = PdoMegaptera::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    public function modifMembre($id, $nom, $prenom, $tel, $mail, $login, $mdp, $poste)
    {
        $req = "UPDATE membre
                SET nom = '$nom', prenom = '$prenom', tel = '$tel', login = '$login', mdp = '$mdp', poste = '$poste'
                WHERE id = '$id'";
        var_dump($req);
        $res = PdoMegaptera::$monPdo->query($req);
    }
}