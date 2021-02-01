<?php
session_start();
ob_start();
require_once("modele/pdoMegaptera.php");
include("modele/functions.php");
$func = FonctionsMegaptera::GetFunct();
$pdo = PdoMegaptera::getPdoMegaptera();
require("vue/v_entete.php");

if(!isset($_REQUEST['uc']))
     $uc = 'connexion';
else
	$uc = $_REQUEST['uc'];

if(isset($_SESSION['poste']))
    require("vue/v_" . $_SESSION['poste'] . ".php");

if(isset($_SESSION['erreurs']) && !empty($_SESSION['erreurs']))
    include("vue/v_erreurs.php");
    $_SESSION['erreurs'] = [];

if(isset($_SESSION['reussite']) && !empty($_SESSION['reussite']))
    include("vue/v_reussite.php");
    $_SESSION['reussite'] = "";


switch($uc)
{
	case 'connexion':
		{
		    include("controleur/c_connexion.php");
		    break;
		}
	case 'menuSuper':
		{
			include("controleur/c_supAdmin.php");
			break;
		}
	case 'menuAdmin':
		{
			include("controleur/c_admin.php");
			break;
		}
	case 'menuMembre':
		{ 
			include("controleur/c_membre.php");
		    break;
		}
}
include("vue/v_pied.php");
ob_end_flush();
