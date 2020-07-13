<?php
include("vue/v_menuSuperAdmin.php");
if(!isset($_REQUEST['action']))
     $action = 'filtre';
else
	$action = $_REQUEST['action'];

switch($action)
{
	case 'ajouterObservation':
	{	$lesLieux = $pdo->getLesLieux();
		$lesDominantes = $pdo->getLesDominantes();
		$lesGroupes = $pdo->getLesGroupes();
		include("vue/v_ajouterObservation.php");
		break;
	} 
	case 'confirmerAjouterObservation':
	{      		
	    echo $_REQUEST['code'];
		echo $_REQUEST['lieu'];
		echo $_REQUEST['latitude'];
		echo $_REQUEST['longitude'];
		$code = $_REQUEST['code'];
		$lieu = $_REQUEST['lieu'];
		$latitude = $_REQUEST['latitude'];
		$longitude = $_REQUEST['longitude'];
		$pdo -> ajouterLieu($code,$lieu,$latitude,$longitude);	
		$lesLignes = $pdo->getLesLieux();
	    include("vue/v_listeLieu.php");
	     break;
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
	    echo $_REQUEST['code'];
		echo $_REQUEST['lieu'];
		echo $_REQUEST['latitude'];
		echo $_REQUEST['longitude'];
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
			$pdo -> ajouterDomin($libelle);
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
			 $libelle=$unMembre['libelle'];
			 include("vue/v_majDominante.php");
			break;	 
    }

	case 'confirmerModifierDominante':
	{
			$id = $_REQUEST['id'];
			$login = $_REQUEST['login'];
		    $pdo -> modificationDominante($id,$dominante);
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
		    $pdo -> modificationMembre($id,$prenom,$login,$mdp,$tel,$mail);
			$lesLignes = $pdo->getLesMembres();
		   include("vue/v_listeMembre.php");

		break;
	}
	case 'supprimerMembre':
	{   
    	$lesMembres = $pdo->getObservationMembre();
		include("vue/v_listeSuppMembre.php");
		break;
	}
	case 'confirmerSupprimerMembre':
	{      
			$id = $_REQUEST['id'];
			$pdo -> suppressionMembre($id);	
			$lesMembres = $pdo->getObservationMembre();
	   	    include("vue/v_listeSuppMembre.php");
	      break;
	}

	/* les types de groupe */
	
	case 'ajouterGroupe':
	{
		include("vue/v_ajouterGroupe.php");
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
			 $libelle=$unGroupe['libelle'];
			 $operateur=$unGroupe['operateur'];
			 $valeur=$unGroupe['valeur'];
			 include("vue/v_majGroupe.php");
			break;	 
    }

	case 'confirmerModifierGroupe':
	{
			$code = $_REQUEST['code'];
			$libelle = $_REQUEST['libelle'];
			$operateur = $_REQUEST['operateur'];
			$valeur = $_REQUEST['valeur'];
		
			// recherche si observation effectué par ce membre ou valider par ce membre
		    $pdo -> modificationGroupe($code,$libelle,$operateur,$valeur);
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