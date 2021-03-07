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
        $login  = htmlspecialchars($_REQUEST['login']);
		$mdp    = htmlspecialchars($_REQUEST['mdp']);
        $membre = $pdo->getInfosMembre($login, $mdp);

        if(!is_array($membre))
        {
			$_SESSION['erreurs'][] = "Identifiant et/ou mot de passe incorrect. Ressayez.";
            header("Location: index.php?uc=connexion");
        }
        else if(is_array($membre) && empty($membre['derniereConnexion']))
        {
            include("vue/v_premiereConnexion.php");
        }
        else
        {
            $_SESSION['reussite']   = "Connexion Réussie. Heureux de vous revoir ". $membre['prenom'];
            $_SESSION['poste']      = $membre['poste'];
            $_SESSION['id']         = $membre['id'];
            header("Location: index.php?uc=observation");
		}
		break;
    }
    case 'deconnexion':
	{
        header("Location:index.php");
        $pdo->__destruction();
		session_destroy();
		break;
	}
    case 'mdp_oublie':
    {
        include("vue/v_mdpOublie.php");
        break;
    }
    case 'mdp_envoi_email':
    {
        $from = $mail->Username;
        $to = $_REQUEST['mail'];
        $membre = $pdo->getUnMembreParMail($to);
        $server = $_SERVER['HTTP_ORIGIN'];
        $route = $_SERVER['SCRIPT_NAME'];
        if(count($membre) != 0)
        {
            try {
                $mail->setFrom($from, 'Megaptera');
                $mail->addAddress($to);     // Add a recipient

                $mail->isHTML(true);
                $mail->Subject = 'Mot de passe perdu';
                $mail->Body    = "Bonjour,\n" . "Merci de bien vouloir suivre le lien ci-dessous afin de rédefinir votre mot de passe:\n" . "<a href=" . "$server" . "/" . "$route" . '?uc=connexion&action=redifinir_mdp' . ">Lien</a>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                $_SESSION['reussite']  = "Un mail contenant votre mot de passe vous a été envoyé. Cela peut prendre quelques minutes";
                header("Location:index.php");
            } catch (Exception $e) {
                header("Location:index.php?action=mdp_oublie");
                $_SESSION['erreurs'][]  = "Une erreur est survenue lors du traitement la requête. Veuillez ressayez.";
            }
        }
        else
        {
            header("Location:index.php?action=mdp_oublie");
            $_SESSION['erreurs'][] = "Cette adresse mail ne correspond à aucun compte.";
        }
        break;
    }
    case 'redefinir_mdp':
    {
        break;
    }
    default:
    {
        header('Location:index.php?action=connexion');
    }
}