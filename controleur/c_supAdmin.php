<?php
include("vue/v_menuSuperAdmin.php");
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
		$dateEnregistrement=date("Y-m-d");
		
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
	case 'validerObservation':
	{  
	    $lesObservations = $pdo-> getObservationNonValide();
		require("vue/v_listeAValiderObservation.php");
		break;
	}
	case 'validerUneObservation':
	{   $codeObsevation = $_REQUEST['codeObservation'];
	    $uneObservation = $pdo-> getUneObservationNonValide($code);
		require("vue/v_validerObservation.php");
		break;
	}
	case 'confirmerValiderUneObservation':
	{
	    $codeObservation = $_REQUEST['code'];
	    
	    $pdo-> validerUneObservation($codeObservation);
		
	    $lesObservations = $pdo-> getObservationNonValide();
		require("vue/v_listeAValiderObservation.php");
		break;
	}
	case 'supprimerObservation':
	{  
	    $lesObservations = $pdo-> getObservationNonValide();
		require("vue/v_listeSuppObservation.php");
		break;
	}
	case 'confirmerSupprimerObservation':
	{      
			$code = $_REQUEST['code'];
			$pdo -> supprimerObservation($code);	
			// supprimer également la photo ?
			$lesObservations = $pdo->getObservationNonValide();
	   	    include("vue/v_listeSuppObservation.php");
	      break;
	}
	case 'listeObservation':
	{
		$lesObservations = $pdo->getLesObservations();
		include("vue/v_listeObservations.php");
       	break;
	}
	case 'modifierObservation':
	{
<<<<<<< Updated upstream
		     $code = $_REQUEST['code'];
			 $uneObservation = $pdo->getUneObservation($code);
			 include("vue/v_majObservation.php");
			break;	 
=======
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
        $code = $_REQUEST['code'];
        $uneObservation = $pdo->getUneObservation($code);
        include("vue/v_majObservation.php");
        break;
>>>>>>> Stashed changes
    }

	case 'confirmerModifierObservation':
	{
<<<<<<< Updated upstream
			$code = $_REQUEST['code'];
			$lieu = $_REQUEST['lieu'];
			$latitude = $_REQUEST['latitude'];
			$longitude = $_REQUEST['longitude'];
			var_dump($lieu);
			$pdo -> modifierObservation($code,$lieu,$latitude,$longitude);	
			$lesLignes = $pdo->getLesLieux();
		   include("vue/v_listeLieu.php");
	      break;
=======
        $code = $_REQUEST['code'];
        $lieu = $_REQUEST['Lieu'];

        $latOrientation = $_POST['latOrientation'];
        $longOrientation = $_POST['longOrientation'];
        $longitude =  $longOrientation . " " . $_POST['DegresLong'] . "°" . $_POST['MinutesLong'] . "'" . $_POST['SecondesLong'] . '"';
        $latitude = $latOrientation . " " . $_POST['DegresLat'] . "°" . $_POST['MinutesLat'] . "'" . $_POST['SecondesLat'] . '"';
        $pdo -> modifierObservation($code,$lieu, addslashes($latitude), addslashes($longitude));


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
        $code = $_REQUEST['code'];
        $uneObservation = $pdo->getUneObservation($code);
        include("vue/v_majObservation.php");

        break;
>>>>>>> Stashed changes
	}
	
	// gestion des lieux
	case 'listeLieu':
	{
		$lesLignes = $pdo->getLesLieux();
		include("vue/v_listeLieu.php");
       	break;
	}
	
	case 'ajouterLieu':
	{
		include("vue/v_ajouterLieu.php");
		break;
	}
    case 'confirmerAjouterLieu':
	{      		
	   
		$code = $_REQUEST['code'];
		$lieu = $_REQUEST['lieu'];
		$latitude = $_REQUEST['latitude'];
		$longitude = $_REQUEST['longitude'];
		$pdo -> ajouterLieu($code,$lieu,$latitude,$longitude);	
		$lesLignes = $pdo->getLesLieux();
	    include("vue/v_listeLieu.php");
	     break;
	}
	
	case 'modifierLieu':
	{  
		    $code = $_REQUEST['code'];
			 $unLieu = $pdo->getUnLieu($code);
			 $lieu=$unLieu['lieu'];
			 $latitude=$unLieu['orientationLat'];
			 $longitude=$unLieu['orientationLong'];
			 include("vue/v_majLieu.php");
			break;	 
    }

	case 'confirmerModifierLieu':
	{
			$code = $_REQUEST['code'];
			$lieu = $_REQUEST['lieu'];
			$latitude = $_REQUEST['latitude'];
			$longitude = $_REQUEST['longitude'];
			var_dump($lieu);
			$pdo -> modifierLieu($code,$lieu,$latitude,$longitude);	
			$lesLignes = $pdo->getLesLieux();
		   include("vue/v_listeLieu.php");
	      break;
	}
	
	case 'supprimerLieu':
	{   
    	$lesLignes = $pdo->getObservationLieu();
		include("vue/v_listeSuppLieu.php");
		break;
	}
	case 'confirmerSupprimerLieu':
	{      
			$code = $_REQUEST['code'];
			$pdo -> supprimerLieu($code);	
			$lesLignes = $pdo->getObservationLieu();
	   	    include("vue/v_listeSuppLieu.php");
	      break;
	}
	
	/* gestion des dominante */
		case 'ajouterDominante':
	{
		include("vue/v_ajouterDominante.php");
		break;
	}
	
    case 'confirmerAjouterDominante':
	{      		
			$libelle = $_REQUEST['libelle'];	
			$pdo -> ajouterDominante($libelle);
			 $lesDominantes = $pdo->getLesDominantes();
			include("vue/v_listeDominante.php");
		
		break;
	}
	case 'listeDominante':
	{   $lesDominantes = $pdo->getLesDominantes();
		include("vue/v_listeDominante.php");
		break;
	}
	
    case 'modifierDominante':
	{  
		     $id = $_REQUEST['id'];
			 $uneDominante = $pdo->getUneDominante($id);
			 $libelle=$uneDominante['libelle'];
			 include("vue/v_majDominante.php");
			break;	 
    }

	case 'confirmerModifierDominante':
	{
			$id = $_REQUEST['id'];
			$libelle = $_REQUEST['libelle'];
		    $pdo -> modifierDominante($id,$libelle);
			$lesDominantes = $pdo->getLesDominantes();
		    include("vue/v_listeDominante.php");

	
		break;
	}
	case 'supprimerDominante':
	{   
    	$lesDominantes = $pdo->getObservationDominante();
		include("vue/v_listeSuppDominante.php");
		break;
	}
	case 'confirmerSupprimerDominante':
	{      
			$id = $_REQUEST['id'];
			$pdo -> supprimerDominante($id);	
			$lesDominantes = $pdo->getObservationDominante();
	   	    include("vue/v_listeSuppDominante.php");
	      break;
	}
	
	/* gestion des membre */
	
	case 'ajouterMembre':
	{
		include("vue/v_ajouterMembre.php");
		break;
	}
	
    case 'confirmerAjouterMembre':
	{      echo "value ??";
	     $login = $_REQUEST['login'];
		 $mdp = $_REQUEST['mdp'];
		 $nb = $pdo -> getInfosMembre($login,$mdp);	
		 
 		if ($nb	> 0)
		{
			?><a id="Error"><?php echo "login et mdp exitent déjà ";?><br></a><?php
			include("vue/v_ajouterMembre.php");
		}
		else 
		{
			$poste = $_REQUEST['poste'];
			$nom = $_REQUEST['nom'];
			$prenom = $_REQUEST['prenom'];
			$mail = $_REQUEST['mail'];
			$tel = $_REQUEST['tel'];
		
			$pdo -> inscriptionMembre($nom,$prenom,$login,$mdp,$tel,$mail,$poste);
	
			 $lesLignes = $pdo->getLesMembres();
			include("vue/v_listeMembre.php");
		}
		break;
	}
	case 'listeMembre':
	{   $lesLignes = $pdo->getLesMembres();
		include("vue/v_listeMembre.php");
		break;
	}
	
    case 'modifierMembre':
	{  
		     $id = $_REQUEST['id'];
			 $unMembre = $pdo->getUnMembre($id);
			 $nom=$unMembre['nom'];
			 $prenom=$unMembre['prenom'];
			 $mail=$unMembre['mail'];
			 $login=$unMembre['login'];
			 $mdp=$unMembre['mdp'];
			 $poste=$unMembre['poste'];
			 $tel=$unMembre['tel'];
			 include("vue/v_majMembre.php");
			break;	 
    }

	case 'confirmerModifierMembre':
	{

			$id = $_REQUEST['id'];
			$login = $_REQUEST['login'];
			$prenom = $_REQUEST['prenom'];
			$mail = $_REQUEST['mail'];
			$tel = $_REQUEST['tel'];
			$mdp = $_REQUEST['mdp'];
			// recherche si observation effectué par ce membre ou valider par ce membre
		    $pdo -> modifierMembre($id,$prenom,$login,$mdp,$tel,$mail);
			$lesLignes = $pdo->getLesMembres();
		   include("vue/v_listeMembre.php");

		break;
	}
    case 'supprimerMembre':
    {
        $lesMembres = $pdo->getLesMembresNonAdmin();
        include("vue/v_listeSuppMembre.php");
        break;
    }
    case 'confirmerSupprimerMembre':

    {
        $id = $_REQUEST['id'];
        $nbObservation = $pdo->getObservationMembre($id);
        $leMembre = $pdo->getUnMembre($id);
        if ($nbObservation[0] == 0)
        {
            $pdo->suppressionMembre($id);

        }
        else
        {
            echo "Vous ne pouvez pas supprimer ce membre car il a des observations validées";
        }
        $lesMembres = $pdo->getLesMembresNonAdmin();
        include("vue/v_listeSuppMembre.php");
        break;
    }

	/* les types de groupe */
	
	case 'ajouterGroupe':
	{
		include("vue/v_ajouterGroupe.php");
		break;
	}
	  case 'confirmerAjouterGroupe':
	{    
	         $code= $_POST['code'];
			 $libelle=$_POST['libelle'];
			 $operateur=$_POST['operateur'];
			 $valeur=$_POST['valeur'];
			$pdo -> ajouterGroupe($code,$libelle,$operateur,$valeur);	
			$lesGroupes = $pdo->getLesGroupes();
	        include("vue/v_listeGroupe.php");
	     break;
	}
	case 'listeGroupe':
	{   $lesGroupes = $pdo->getLesGroupes();
		include("vue/v_listeGroupe.php");
		break;
	}
	
    case 'modifierGroupe':
	{  
		     $code= $_REQUEST['code'];
			 $unGroupe = $pdo->getUnGroupe($code);
			 $code = $unGroupe['code'];
			 $libelle=$unGroupe['libelle'];
			 $operateur=$unGroupe['operateur'];
			 $valeur=$unGroupe['valeur'];
			 include("vue/v_majGroupe.php");
			break;	 
    }

	case 'confirmerModifierGroupe':
	{
			$code = $_REQUEST['code'];
			$libelle = $_POST['libelle'];
			$operateur = $_POST['operateur'];
			$valeur = $_POST['valeur'];
		
		
			// recherche si observation effectué par ce membre ou valider par ce membre
		    $pdo -> modifierGroupe($code,$libelle,$operateur,$valeur);
			
			$lesGroupes = $pdo->getLesGroupes();
		   include("vue/v_listeGroupe.php");
		break;
	}
	case 'supprimerGroupe':
	{   
    	$lesGroupes = $pdo->getObservationGroupe();
		include("vue/v_listeSuppGroupe.php");
		break;
	}
	case 'confirmerSupprimerGroupe':
	{      
			$code = $_REQUEST['code'];
			$pdo -> supprimerGroupe($code);	
			$lesGroupes = $pdo->getObservationGroupe();
	   	    include("vue/v_listeSuppGroupe.php");
	      break;
	}
}
?>