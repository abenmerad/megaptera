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
    case 'rechercheMesObservations':
    {
        $lesEtatsObservations = $pdo->getLesEtatsObservation();
        $lesGroupes = $pdo -> getLesGroupes();
        $lesLieux = $pdo -> getLesLieux();
        include("vue/v_rechercheMesObservations.php");
        break;
    }
    case 'mesObservations':
    {
        $err = [];
        $annee = $_POST['anneeObs'];
        $etat = $_POST['etatObs'];
        $groupe = $_POST['groupeObs'];
        $lieu = $_POST['lieuObs'];

        $lesEtatsObservations = $pdo->getLesEtatsObservation();
        $lesGroupes = $pdo -> getLesGroupes();
        $lesLieux = $pdo -> getLesLieux();
        $lesObservations = $pdo->getLesObservationsParFiltre($_SESSION['id'], $annee, $etat, $groupe, $lieu);

        if(count($lesObservations) != 0)
        {
            $donnees = $_REQUEST;
            include("vue/v_rechercheMesObservations.php");
            include("vue/v_mesObservations.php");
        }
        else
        {
            $err[] = "Aucun resultat trouvé pour cette recherche";
            $_SESSION['erreurs'] = $err;
            include("vue/v_erreurs.php");
            include("vue/v_rechercheMesObservations.php");
        }

        break;
    }
	case 'confirmer':
    {
        $comportementObservation = $_POST['Comportement'];
        $commentaireObservation = $_POST['Description'];
        $lieuInfo = "";
        $monLieu = [];
        $heureDebut = "";
        $heureFin = "";
        $couleurDominante = "";
        $nbIndividu = "";
        $typeCaudale = "";
        $typeGroupe = "";
        $aPapillon = "";
        $lieuObservation = "";
        $dateObservation = "";

        $today = date('Y-m-d', time());
        $err = [];
        $donnees = $_REQUEST;
        $_SESSION['erreurs'] = $err;
        $message = "";
        switch ($_FILES['nomImg']['error']) {
            case 0:
            {
                $nomPhoto = $_FILES['nomImg']['name'];
                break;
            }
            case 1:
            {
                $message = "L'image est trop lourde pour être téléchargée.";
                $err[] = $message;
                break;
            }
            case 4:
            {
                $message = "Aucune image n'a été téléchargé.";
                $err[] = $message;
                break;
            }
            default:
            {
                $message = "Une erreur est survenue lors du téléchargement. Ressayez.";
                $err[] = $message;
                break;
            }
        }
        if ($_POST['Lieu'] != "NULL") {
            if ($_POST['Lieu'] == "Autre") {
                if (empty($_POST['LieuAutre'])) {
                    $message = "Les informations du lieu ne sont pas remplis.";
                    $err[] = $message;
                } else {
                    $lieuInfo = $_POST['LieuAutre'];
                    $lieuObservation = "AUT";
                }
            } else {
                $lieuObservation = $_POST['Lieu'];
                $monLieu = $pdo->getUnLieu($_POST['Lieu']);
            }
        } else {
            $message = "Veuillez choisir un lieu d'observation.";
            $err[] = $message;
        }
        if (empty($_POST['HeureDebut']) || empty($_POST['HeureFin'])) {
            $message = "Veuillez entrer une heure de début et de fin.";
            $err[] = $message;
        } else if (date($_POST['HeureDebut']) > date($_POST['HeureFin'])) {
            $message = "L'heure du début d'observation ne peut être supérieure à l'heure de fin.";
            $err[] = $message;
        } else {
            $heureDebut = date($_POST['HeureDebut']);
            $heureFin = date($_POST['HeureFin']);
        }

        if (empty($_POST['DateObservation'])) {
            $message = "Aucune date d'observation n'a été entrée.";
            $err[] = $message;
        } else if ($_POST['DateObservation'] > $today) {
            $message = "La date d'observation ne peut être supérieure à la date du jour.";
            $err[] = $message;
        } else {
            $dateObservation = $_POST['DateObservation'];
        }

        if ($_POST['Dominante'] == "NULL") {
            $message = "Veuillez selectionner une dominante.";
            $err[] = $message;
        } else {
            $couleurDominante = $_POST['Dominante'];
        }
        if ($_POST['Caudale'] == "NULL") {
            $message = "Veuillez selectionner un type de caudale.";
            $err[] = $message;
        } else {
            $typeCaudale = $_POST['Caudale'];
        }

        if ($_POST['Papillon'] == "NULL") {
            $message = "Veuillez selectionner un papillon.";
            $err[] = $message;
        } else {
            $aPapillon = $_POST['Papillon'];
        }
        if ($_POST['Groupe'] == "NULL") {
            $message = "Veuillez selectionner un type de groupe.";
            $err[] = $message;
        } else {
            $typeGroupe = $_POST['Groupe'];
        }
        if ($_POST['NombreIndividu'] == "NULL") {
            $message = "Le nombre d'individus ne peut être nul.";
            $err[] = $message;
        } else {
            $nbIndividu = $_POST['NombreIndividu'];
        }

        if (!empty($err)) {
            $lesLieux = $pdo->getLesLieux();
            $lesDominantes = $pdo->getLesDominantes();
            $lesGroupes = $pdo->getLesGroupes();
            $_SESSION['erreurs'] = $err;
            include("vue/v_erreurs.php");
            include("vue/v_ajouterObservation.php");
        } else {
            {
                $_SESSION['erreurs'] = [];
                $rechercheCode = $lieuObservation . substr($dateObservation, 0, 4);
                $nbCaracteres = strlen($rechercheCode);
                $num = $pdo->dernierCodeObs($rechercheCode);

                if (!is_null($num[0])) {
                    settype($num[0], "string");
                    $longueur = strlen($num[0]);
                    $numero = substr($num[0], $nbCaracteres, 3);
                    $numero = $numero + 1;
                } else {
                    $numero = 1;
                }

                $codeObservation = $rechercheCode . $numero;
                $longitude =  $monLieu['orientationLat'] . " " . $_POST['DegresLong'] . "°" . $_POST['MinutesLong'] . "'" . $_POST['SecondesLong'] . '"';
                $latitude = $monLieu['orientationLong'] . " " . $_POST['DegresLat'] . "°" . $_POST['MinutesLat'] . "'" . $_POST['SecondesLat'] . '"';
                $auteur = $_SESSION['id'];
                $nomPhoto = $codeObservation . '.' . explode("/", $_FILES['nomImg']['type'])[1];
                $pdo->ajouterObservation($codeObservation, $nomPhoto, $lieuObservation, $lieuInfo, $heureDebut, $heureFin, $dateObservation, addslashes($latitude), addslashes($longitude), $auteur, (int)$couleurDominante, $aPapillon, (int)$nbIndividu, (int)$typeCaudale, $typeGroupe, $commentaireObservation, $comportementObservation);
                $repertoire = 'images/' . $lieuObservation . '/' . $codeObservation . '.' . explode("/", $_FILES['nomImg']['type'])[1];

                move_uploaded_file($_FILES['nomImg']['tmp_name'], $repertoire);
            }
        }
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