<?php
session_start();
session_regenerate_id();

require_once("modele/pdoMegaptera.php");
require_once("modele/functions.php");
require_once("modele/Token.php");
require_once("modele/ajax.php");
require_once("modele/Mail.php");
require_once('modele/GLOBALS.php');
$func   = new FonctionsMegaptera();
$token  = new Token();
$pdo    = PdoMegaptera::getPdoMegaptera();

require_once("vue/v_entete.php");

if(!isset($_REQUEST['uc']))
    $uc  = 'connexion';
else
    $uc  = $_REQUEST['uc'];

if(isset($_SESSION['poste']))
    require("vue/v_menu" . $_SESSION['poste'] . ".php");

if(isset($_SESSION['erreurs']) && !empty($_SESSION['erreurs']))
    include("vue/v_erreurs.php");
    $_SESSION['erreurs'] = [];

if(isset($_SESSION['reussite']) && !empty($_SESSION['reussite']))
    include("vue/v_reussite.php");
    $_SESSION['reussite'] = "";

$mailer = Mail::getMail($func -> lireFichierServeur(fopen("exemple.txt", "r")));

switch($uc)
{
	case 'connexion':
		{
		    include("controleur/c_connexion.php");
		    break;
		}
    case 'gestion':
        {
            if(isset($_SESSION['poste']) && $_SESSION['poste'] != "Membre")
            {
                include ("controleur/c_gestion.php");
            }
            else if(isset($_SESSION['poste']) && $_SESSION['poste'] == "Membre")
            {
                $_SESSION['erreurs'][] = "Vous avez été redirigé, car vous n'êtes pas autorisé à consulter cette page";
                header("Location:index.php?uc=observation&action=rechercheObservations");
            }
            else
            {
                $_SESSION['erreurs'][] = "Vous devez être connecté pour accéder à cette page.";
                header("Location:index.php?uc=connexion");
            }
            break;
        }
    case 'observation':
        {
            if(isset($_SESSION['poste']))
            {
                include("controleur/c_observation.php");
            }
            else
            {
                header("Location:index.php?uc=connexion");
            }
            break;
        }
    case 'profil':
    {
        if(isset($_SESSION['poste']))
        {
            include("controleur/c_profil.php");
        }
        else
        {
            header("Location:index.php?uc=connexion");
        }
        break;
    }
    default:
    {
        header('Location:' . ROOT_DIR . '?uc=connexion');
    }
}
include("vue/v_pied.php");
