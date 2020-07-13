<?php
include("vue/v_menuAdmin.php"); 
if(!isset($_REQUEST['action']))
     $action = 'filtre';
else
	$action = $_REQUEST['action'];

switch($action)
{
		
	
  
    case 'filtre' :
	{
        echo "bonjour";
		
		break;
    } 
	
  /* gestion des membre */
	
	
	case 'ajouterMembre':
	{   echo "valeur C $uc";	
		include("vue/v_ajouterMembre.php");
		break;
	}
	
    case 'confirmerAjouterMembre':
	{  
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
	
			 $lesLignes = $pdo->getLesMembresAdmin();
			include("vue/v_listeMembre.php");
		}
		break;
	}
	case 'listeMembre':
	{   $lesLignes = $pdo->getLesMembresAdmin();
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
			$lesLignes = $pdo->getLesMembresAdmin();
		   include("vue/v_listeMembre.php");

		break;
	}
	case 'supprimerMembre':
	{   
    	$lesMembres = $pdo->getObservationMembreAdmin();
		include("vue/v_listeSuppMembre.php");
		break;
	}
	case 'confirmerSupprimerMembre':
	{      
			$id = $_REQUEST['id'];
			$pdo -> suppressionMembre($id);	
			$lesMembres = $pdo->getObservationMembreAdmin();
	   	    include("vue/v_listeSuppMembre.php");
	      break;
	}

}
?>