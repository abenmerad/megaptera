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
	case 'confirmer':
	{
	    $nomPhoto = $_FILES['nomImg']['name'];

		if ($_POST['Lieu']== "Autre")
		{ 
		    $lieuObservation = "AUT";
		}
		else
		{
	   	    $lieuObservation = $_POST['Lieu'];
		}
		
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
		$dateEnregistrement = date("Y-m-d");
		
		$rechercheCode = $lieuObservation.substr($dateObservation,0,4);
		
		$nbCaracteres = strlen($rechercheCode);
		
		
		$num = $pdo -> dernierCodeObs($rechercheCode);

		
	    if (!is_null($num[0]))
		{  
		    settype($num[0], "string");
			$longueur = strlen($num[0]);	
		    $numero = substr($num[0],$nbCaracteres ,3);
			$numero = $numero +1 ;
		}
		else
		{
			$numero = 1 ;
			
		}	
		
		$codeObservation = $rechercheCode.$numero;
		
		
		$longitude = $_POST['DegresLong'] . "°" .  $_POST['MinutesLong'] . "\'" .  $_POST['SecondesLong']. '\"';
		$latitude =  $_POST['DegresLat'] . "°" .  $_POST['MinutesLat'] . "\'" .  $_POST['SecondesLat']. '\"' ;
	
		
		$auteur = $_SESSION['id'];
		
		$nomPhoto = $codeObservation.'.'.explode("/", $_FILES['nomImg']['type'])[1];
		
		$pdo -> ajouterObservation($codeObservation, $nomPhoto,  $lieuObservation, $lieuInfo, $heureDebut, $heureFin, $dateObservation, $latitude, $longitude, $auteur,(int)$couleurDominante, $aPapillon, (int)$nbIndividu, (int)$typeCaudale, $typeGroupe, $commentaireObservation, $comportementObservation, $dateEnregistrement);

		$repertoire = 'images/'.$codeObservation.'.'.explode("/", $_FILES['nomImg']['type'])[1];
		
		move_uploaded_file($_FILES['nomImg']['tmp_name'], $repertoire);

		break;
	}


case 'filtre':
	{  
	    $lesLieux = $pdo -> getLesLieux();
		$lesDominantes = $pdo -> getLesDominantes();
		$lesGroupes = $pdo -> getLesGroupes();
		$lesAnnees =$pdo -> getLesAnnees();
		
		$lieuxASelectionner ='';
		$dominanteASelectionner = '';
		$AnneeASelectionner = '';
		$groupesASelectionner = '';
		
		require("vue/v_filtre.php");
		break;
	}
    case 'rechercher':
	{  
	    $lesLieux = $pdo -> getLesLieux();
		$lesDominantes = $pdo -> getLesDominantes();
		$lesGroupes = $pdo -> getLesGroupes();
		$lesAnnees =$pdo -> getLesAnnees();
		
		$lieu = $_POST['Lieu'];
		$lieuxASelectionner = $lieu;
		
		$annee = $_POST['Annee'];
		$anneeASelectionner = $annee;
		
		$dominante = $_POST['Dominante'];
		$dominanteASelectionner = $dominante;
		
		
		$typeGroupe = $_POST['Groupe'];
		$groupeASelectionner = $typeGroupe;
		include("vue/v_filtre.php");
	
		$lesObservations = $pdo-> getRechercheObservation($lieu,$annee,(int)$dominante, $typeGroupe);
		
		
		include("vue/v_RechercheObservation.php");
		break;
	}
	
}
?>