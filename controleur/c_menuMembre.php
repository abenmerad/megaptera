<?php
if(!isset($_REQUEST['action']))
    $action = 'filtre';
else
	$action = $_REQUEST['action'];

switch($action)
{
    case 'filtre':
	{  
	    $lesLieux               = $pdo -> getLesLieux();
		$lesDominantes          = $pdo -> getLesDominantes();
		$lesGroupes             = $pdo -> getLesGroupes();
		$lesAnnees              = $pdo -> getLesAnnees();
		$lieuxASelectionner     = '';
		$dominanteASelectionner = '';
		$AnneeASelectionner     = '';
		$groupesASelectionner   = '';
		require("vue/v_filtre.php");
		break;
	}
    case 'rechercher':
	{
	    $lesLieux               = $pdo -> getLesLieux();
		$lesDominantes          = $pdo -> getLesDominantes();
		$lesGroupes             = $pdo -> getLesGroupes();
		$lesAnnees              = $pdo -> getLesAnnees();

		$lieu                   = $_POST['Lieu'];
		$lieu                   = $_POST['Lieu'];
		$lieuxASelectionner     = $lieu;

		$annee                  = $_POST['Annee'];
		$anneeASelectionner     = $annee;

		$dominante              = $_POST['Dominante'];
		$dominanteASelectionner = $dominante;

		$typeGroupe             = $_POST['Groupe'];
		$groupeASelectionner    = $typeGroupe;
		include("vue/v_filtre.php");

		$lesObservations        = $pdo -> getRechercheObservation($lieu,$annee,(int)$dominante, $typeGroupe);

		include("vue/v_RechercheObservation.php");
		break;
	}
    default:
    {
        header('Location:index.php');
    }
}