<?php
include("vue/v_menuMembre.php"); 
if(!isset($_REQUEST['action']))
    $action = 'filtre';
else
	$action = $_REQUEST['action'];

switch($action)
{
	
	case 'ajouter':
	{
			if(isset($_GET['codeLieu']))
			{
				$unLieu = $pdo -> getUnLieu($_GET['codeLieu']);
				die($unLieu['orientationLat'] . $unLieu['orientationLong']);
			}
			if(isset($_GET['codeGrp']))
			{
				$unGroupe = $pdo -> getUnGroupe($_GET['codeGrp']);
				die($unGroupe['operateur'] . $unGroupe['valeur']);
			}
			$lesLieux = $pdo -> getLesLieux();
			$lesDominantes = $pdo -> getLesDominantes();
			$lesGroupes = $pdo -> getLesGroupes();
			require("vue/v_ajouterObservation.php");
			break;
	}
	case 'Confirmer':
	{
		$nomPhoto = $_POST['nomObservation'];
		$lieuObservation = $_POST['Lieu'];
		$lieuInfo = $_POST['LieuAutre'];
		$dateObservation = $_POST['DateObservation'];
		$heureDebut = $_POST['HeureDebut'];
		$heureFin = $_POST['HeureFin'];
		$couleurDominante = $_POST['Dominante'];
		$typeCaudale = $_POST['Caudale'];
		$aPapillon = $_POST['Papillon'];
		$nbIndividu = $_POST['NombreIndividu'];
		$typeGroupe = $_POST['Groupe'];
		$comportementObservation = $_POST['Comportement'];
		$commentaireObservation = $_POST['Description'];
		$anneeObservation = $_POST['annee'];
		$longitude = $_POST['longOrientation'] . ' ' .  $_POST['DegresLong'] . '°' .  $_POST['SecondesLong'] . '"' .  $_POST['MinutesLong'] . "\'";
		$latitude = $_POST['latOrientation'] . ' ' .  $_POST['DegresLat'] . '°' .  $_POST['SecondesLat'] . '"' .  $_POST['MinutesLat'] . "\'";
		$auteur = $pdo -> getUnMembre($_SESSION['id']);
		$auteur = $auteur['nom'] . ' ' . $auteur['prenom'];

		$pdo -> ajouterObservation($nomPhoto, (int)$couleurDominante, $lieuObservation, $lieuInfo, $heureDebut, $heureFin, $dateObservation, $latitude, $longitude, $auteur, $aPapillon, (int)$nbIndividu, (int)$typeCaudale, $typeGroupe, $commentaireObservation, $comportementObservation);
		
		$idPhoto = $pdo -> dernierEnregistrementObs();
		$idPhoto = $idPhoto['codeObservation'];
		$repertoire = 'images/' . $lieuObservation . '/' .$nomPhoto . $idPhoto . '.' . explode(".", $_FILES['nomImg']['name'])[1];
		
		move_uploaded_file($_FILES['nomImg']['tmp_name'], $repertoire);

		include("vue/v_menuMembre.php");
		break;
	}



}
?>