<?php
session_start();

require_once("modele/pdoMegaptera.php");
include("vue/v_entete.php") ;            

if(!isset($_REQUEST['uc']))
     $uc = 'connexion';
else
	$uc = $_REQUEST['uc'];
 
$pdo = PdoMegaptera::getPdoMegaptera();

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
include("vue/v_pied.php") ;
?>