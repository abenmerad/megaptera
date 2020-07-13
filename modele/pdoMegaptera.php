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
	}

	/* La fonction _destruction  */
	public function _destruction(){
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
		WHERE login = '$login' and mdp = '$mdp'";
		$res = PdoMegaptera::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
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
		$res = PdoMegaptera::$monPdo->exec($req);
	}
	public function modificationMembre($id,$prenom,$login,$mdp,$tel,$mail)
	{
		$req = "update membre set prenom = $prenom, login=$login, mdp= $mdp, tel= $tel, mail = $mail where id=$id";
		$res = PdoMegaptera::$monPdo->exec($req);
	}
    public function SuppressionMembre($id)
	{
		$req = "delete from membre where id=$id";
		$res = PdoMegaptera::$monPdo->exec($req);
	}
	
	public function getObservationMembre()
	{
		$req = "SELECT * FROM membre where id not in(select auteurObservation
		                                               from observation)
				union
				select * from membre where id not in(select numAdministrateur from observation)";
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	public function getObservationMembreAdmin()
	{
		$req = "SELECT * FROM membre where id not in(select auteurObservation
		                                               from observation) and poste='membre'";
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
		public function getObservationDominante()
	{
		$req = "SELECT * FROM dominante where id not in(select dominante
		                                               from observation)";
				
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	public function ajouterLieu($code,$lieu,$latitude,$longitude)
	{
		$req = "INSERT INTO lieu VALUES ('$code','$lieu','$latitude','$longitude')";
		$res = PdoMegaptera::$monPdo->exec($req);
	}
	public function modifierLieu($code,$lieu,$latitude,$longitude)
	{
		$req="update lieu set lieu = '$lieu' , orientationLat = '$latitude', orientationLong = '$longitude' where code='$code'";
		$res = PdoMegaptera::$monPdo->exec($req);
	}	
	public function supprimerLieu($code)
	{
		$req="delete from Lieu where code='$code'";
		$res = PdoMegaptera::$monPdo->exec($req);
	}
	public function getObservationLieu()
	{
		$req = "SELECT * FROM lieu where code not in(select lieu
		                                               from observation)";
		$res = PdoMegaptera::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	public function ajouterDominante($libelle)
	{
		$req = "INSERT INTO dominante VALUES ('$libelle')";
		$res = PdoMegaptera::$monPdo->exec($req);
	}
	public function modifierDominante($id,$libelle)
	{
		$req = "update dominante set libelle = $libelle where id = $id";
		$res = PdoMegaptera::$monPdo->exec($req);
	}

	public function supprimerDominante($id)
	{
		$req="delete from dominante where id=$id";
		$res = PdoLafleur::$monPdo->exec($req);
	}
    public function ajouterTypeGroupe($code,$libelle,$operateur,$valeur)
	{
		$req = "INSERT INTO typegroupe VALUES ('$code','$libelle','$operateur','$valeur')";
		$res = PdoMegaptera::$monPdo->exec($req);
	}
    public function modifierTypeGroupe($code,$libelle,$operation,$valeur)
	{
		$req = "update typegroupe set libelle = $libelle, operation = $operation , valeur = $valeur where code = '$code'";
		$res = PdoMegaptera::$monPdo->exec($req);
	}

	public function supprimerTypeGroupe($code)
	{
		$req="delete from typegroupe where code=$code";
		$res = PdoLafleur::$monPdo->exec($req);
	}

	public function dernierEnregistrementObs()
	{
		$req = "SELECT * FROM `observation` WHERE codeObservation = (SELECT MAX(codeObservation) FROM `observation`);";
		$res = PdoMegaptera::$monPdo->query($req);
		$dernier = $res->fetch();
		return $dernier;
	}

	public function ajouterObservation($photo, $dominante, $lieu, $lieuInfo, $heureDeb, $heureFin, $date, $latitude, $longitude, $auteur, $papillon, $nbInd, $caudale, $groupe, $com, $comp)
	{
		try
		{
			$req = "INSERT INTO observation(dateEnregistrement, nomPhoto, dominante, lieuObservation, autreLieu, heureDebutObservation, heureFinObservation, dateObservation, latitude, longitude, auteurObservation, papillon, nbIndividus, typeCaudale, TypeGroupeObserve, commentaire, comportement) VALUES (NOW(), '$photo', $dominante,'$lieu','$lieuInfo', '$heureDeb', '$heureFin', '$date', '$latitude', '$longitude', '$auteur', '$papillon', $nbInd, $caudale, '$groupe','$com','$comp')";
			$res = PdoMegaptera::$monPdo->exec($req);
		}
		catch(Exception $e)
		{
			die('Erreur' . $e);
		}
	}

	public function MajObservation($repertoireDestination,$code,$lieu,$comme,$anne,$domi,$cauda,$papi,$ID,$heureDebut,$heureFin,$auteur,$TG,$NBi,$comp,$latitude,$longitude)
	{
		$req = "update  INTO photo(Photo_caudale, Code, Lieu, Commentaires, Année, Dominant, TypeCaudale, Papillon, ID, DateEnregistrement, HeureDebut, HeureFin, Auteur, TypeGroupe, NbrIndividu, Comportement, Latitude, Longitude) VALUES ('$repertoireDestination','$code','$lieu','$comme','$anne','$domi','$cauda','$papi','$ID',NOW(),'$heureDebut','$heureFin','$auteur','$TG','$NBi','$comp','$latitude','$longitude')";
		$res = PdoMegaptera::$monPdo->query($req);
	}
}