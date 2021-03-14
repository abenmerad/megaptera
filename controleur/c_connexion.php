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
	        header("Location: index.php?uc=observation");
		break;
	}
    case 'valider' :
	{
        $login      =   htmlspecialchars($_REQUEST['login']);
		$mdp        =   htmlspecialchars($_REQUEST['mdp']);
        $membre     =   $pdo   -> getInfosMembre($login, $mdp);
        $monToken   =   $token -> tokenGeneration();

        if(!is_array($membre))
        {
			$_SESSION['erreurs'][] = "Identifiant et/ou mot de passe incorrect. Ressayez.";
            header("Location: index.php?uc=connexion");
        }
        else if(is_array($membre) && empty($membre['derniereConnexion']))
        {
            $_SESSION['token'] = $monToken;
            header("Location: index.php?uc=connexion&action=modifierMdp&id=" . $membre['id'] . "&token=" . $monToken);
        }
        else
        {
            $_SESSION['reussite']   = "Connexion Réussie. Heureux de vous revoir ". $membre['prenom'];
            $_SESSION['poste']      = $membre['poste'];
            $_SESSION['id']         = $membre['id'];
            $_SESSION['token']      = $monToken;
            $pdo -> connexion($membre['id']);
            header("Location: index.php?uc=observation");
		}
		break;
    }
    case 'modifierMdp':
    {
        if(isset($_REQUEST['id']) && isset($_REQUEST['token']))
        {
            include("vue/v_modifierMdp.php");
        }
        else
        {
            $_SESSION['erreurs'][] = "Vous n'êtes pas autorisé à accéder à cette page.";
            header("Location:index.php?uc=connexion");
        }
        break;
    }
    case 'validerModifierMdp':
    {
        if(isset($_REQUEST['mdp']) && isset($_REQUEST['mdp_repeat']) && isset($_REQUEST['id'])  && isset($_REQUEST['token']))
        {
            $mdp            = htmlspecialchars($_REQUEST['mdp']);
            $mdpRepeat      = htmlspecialchars($_REQUEST['mdp_repeat']);
            $id             = htmlspecialchars($_REQUEST['id']);
            $tk             = htmlspecialchars($_REQUEST['token']);
            $tokenMembre    = $pdo -> getToken($id);

            if($mdp == $mdpRepeat)
            {
                if(isset($_SESSION['token']) && $token -> tokenVerification($_REQUEST['token'], $_SESSION['token']))
                {
                    try
                    {
                        $pdo -> modifierMdpMembre($id, $mdp);
                        $_SESSION['reussite'] = "Mot de passe changé avec succès.";
                        header("Location:index.php?uc=connexion");
                    }
                    catch(Exception $e)
                    {
                        echo $e->getMessage();
                    }
                }
                else if(!empty($tokenMembre) && $token -> tokenVerification($_REQUEST['token'], $tokenMembre))
                {
                    try
                    {
                        $pdo -> modifierMdpMembre($id, $mdp);
                        $pdo -> setToken($id, null);
                        $_SESSION['reussite'] = "Mot de passe changé avec succès.";
                        header("Location:index.php?uc=connexion");
                    }
                    catch(Exception $e)
                    {
                        echo $e->getMessage();
                    }
                }
                else
                {
                    $_SESSION['erreurs'][] = "Vous n'êtes pas autorisé à accéder à cette page.";
                    header("Location:index.php?uc=connexion");
                }
            }
            else
            {
                $_SESSION['erreurs'][] = "Les mots de passe ne correspondent pas.";
                header("Location:index.php?uc=connexion&action=modifierMdp&id=" . $id . " &token=" . $tk);
            }

        }
        else
        {
            $_SESSION['erreurs'][] = "Vous n'êtes pas autorisé à accéder à cette page.";
            header("Location:index.php?uc=connexion");
        }
        break;
    }
    case 'deconnexion':
	{
        header("Location:index.php");
        $pdo -> __destruction();
        $mailer -> __destruction();
		session_destroy();
		die();
    }
    case 'mdp_oublie':
    {
        include("vue/v_mdpOublie.php");
        break;
    }
    case 'mdp_envoi_email':
    {
        if(isset($_REQUEST['mail']))
        {
            $membre     = $pdo   -> getUnMembreParMail(htmlspecialchars($_REQUEST['mail']));
            $tokenMail  = $token -> tokenGeneration();
            if(is_array($membre) && count($membre) != 0)
            {
                try {
                    $pdo    -> setToken($membre['id'], $tokenMail);
                    $mailer -> ecrireMail($_REQUEST['mail'],
                                         "Definir nouveau mot de passe",
                                         "Bonjour,<br><br> 
                                          Merci de bien vouloir suivre le lien ci-dessous afin de rédefinir votre mot de passe: <br><br> 
                                          <b>Login : </b>" . $membre['login'] . "
                                          <a href=\"" . ROOT_DIR . "?uc=connexion&action=modifierMdp&id=" . $membre['id'] . "&token=" . $tokenMail . "\">Lien</a><br><br> 
                                          L'équipe MEGAPTERA");
                    $_SESSION['reussite']  = "Un mail contenant votre mot de passe vous a été envoyé. Cela peut prendre quelques minutes";
                    header("Location:index.php");
                } catch (Exception $e) {
                    echo $e->getMessage();
                    $_SESSION['erreurs'][]  = "Une erreur est survenue lors du traitement la requête. Veuillez ressayez.";
                    header("Location:index.php?action=mdp_oublie");
                }
            }
            else
            {
                header("Location:index.php?action=mdp_oublie");
                $_SESSION['erreurs'][] = "Cette adresse mail ne correspond à aucun compte.";
            }
        }
        else
        {
            header("Location:index.php?uc=connexion&action=mdp_oublie");
        }
        break;
    }
    default:
    {
        header('Location:index.php?uc=connexion');
    }
}