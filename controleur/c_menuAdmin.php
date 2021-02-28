<?php
if(!isset($_REQUEST['action']))
     $action = 'filtre';
else
	$action = $_REQUEST['action'];

switch($action)
{
    case 'filtre':
	{
		break;
    }
	case 'ajouterMembre':
	{
		include("vue/v_ajouterMembre.php");
		break;
	}

    case 'confirmerAjouterMembre':
	{
        $login = $_REQUEST['login'];
        $mdp = $_REQUEST['mdp'];
        $nb = $pdo -> getInfosMembre($login,$mdp);
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
			$poste = $_REQUEST['poste'];
            $nom=$_REQUEST['nom'];
			// recherche si observation effectué par ce membre ou valider par ce membre
		    $pdo -> modifMembre($id, $nom, $prenom, $tel, $mail, $login, $mdp, $poste);
			$lesLignes = $pdo->getLesMembresAdmin();
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

    case 'modifierObservation':
    {
        $code = $_REQUEST['code'];
        $uneObservation = $pdo->getUneObservation($code);

        include("vue/v_majObservation.php");
        break;
    }

    case 'confirmerModifierObservation':
    {
        $code = $_REQUEST['code'];
        $lieu = $_REQUEST['lieu'];
        $latitude = $_REQUEST['latitude'];
        $longitude = $_REQUEST['longitude'];
        $pdo -> modifierObservation($code,$lieu,$latitude,$longitude);
        $lesLignes = $pdo->getLesLieux();
        include("vue/v_listeLieu.php");
        break;
    }

    case 'validerObservation':
    {

        $lesLignes = $pdo-> getObservationNonValide();
        foreach($lesLignes as $uneLigne)
        {
            if($uneLigne['lieuObservation'] != 'AUT')
            {
                $lesObservations[] =  $uneLigne;
            }
        }
        require("vue/v_listeAValiderObservation.php");
        break;
    }
    case 'confirmerValiderUneObservation':
    {   $codeObservation = $_REQUEST['code'];
        $pdo-> validerUneObservation($codeObservation);
        header('Location: index.php?uc=menuAdmin&action=validerObservation');
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
    default:
    {
        header('Location:index.php');
    }
}