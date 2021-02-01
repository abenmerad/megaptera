<?php
if(!isset($_REQUEST['action']))
     $action = 'connexion';
else
	$action = $_REQUEST['action'];

switch($action)
{	
	case 'connexion':
	{
	    if(!isset($_SESSION['poste']))
		    include("vue/v_connexion.php");
	    else
	        header("Location: index.php?uc=" . $_SESSION['poste']);
		break;
	}
    case 'valider' :
	{
        $login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];

        $membre = $pdo->getInfosMembre($login,$mdp);
        if(!is_array($membre))
        {
			$_SESSION['erreurs'][] = "Identifiant et/ou mot de passe incorrect. Ressayez.";
            header("Location: index.php?uc=connexion");
        }
        else 
        {
            $_SESSION['reussite'] = "Connexion Réussie. Heureux de vous revoir ". $membre['prenom'];
            switch($membre['poste'])
            {
                case 'membre':
                {
                    $_SESSION['poste']='menuMembre';
                    $_SESSION['id']= $membre['id'];
                    break;
                }
                case 'Admin':
                {
                    $_SESSION['poste']='menuAdmin';
                    $_SESSION['id'] = $membre['id'];
                    break;
                }
                case 'superAdmin':
                {
                    $_SESSION['poste']='menuSuper';
                    $_SESSION['id']= $membre['id'];
                    break;
                }
                default:
                {
                    $_SESSION['erreurs'][] = "Vous n'êtes pas autorisé";
                    $_SESSION['reussite'] = "";
                    break;
                }
            }
            if(!empty($_SESSION['erreurs']))
            {
                header("Location: index.php?uc=connexion");
            }
            else
            {
                header("Location: index.php?uc=" . $_SESSION['poste']);
            }
		}
		break;
    } 
	
    case 'deconnexion':
	{
        $pdo->__destruction();
		if(session_destroy())
            header("Location: index.php?uc=connexion");
		break;
	}
}