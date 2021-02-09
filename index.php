<?php
session_start();

require_once("modele/pdoMegaptera.php");
include ("modele/functions.php");
$func = FonctionsMegaptera::GetFunct();
$pdo = PdoMegaptera::getPdoMegaptera();
include("vue/v_entete.php") ;            

if(!isset($_REQUEST['uc']))
     $uc = 'connexion';
else
	$uc = $_REQUEST['uc'];


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
    case 'gestion':
        {
            include("controleur/c_gestion.php");
        }
}
include("vue/v_pied.php") ;
