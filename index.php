<?php
session_start();
session_regenerate_id();

require_once("modele/pdoMegaptera.php");
include("modele/functions.php");
include ("modele/ajax.php");
require 'include_path/PHPMailer/src/Exception.php';
require 'include_path/PHPMailer/src/PHPMailer.php';
require 'include_path/PHPMailer/src/SMTP.php';
require 'include_path/PHPMailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

//$mail->SMTPDebug  = SMTP::DEBUG_SERVER;                       // Enable verbose debug output
$mail->isSMTP();                                                // Send using SMTP
$mail->Host       = 'smtp.mail.yahoo.com';                      // Set the SMTP server to send through
$mail->SMTPAuth   = true;                                       // Enable SMTP authentication
$mail->Username   = 'mega_ptera@yahoo.com';                     // SMTP username
$mail->Password   = 'efxgrdgnfztjusoi';                         // SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                // Enable TLS encryption; `` encouraged
$mail->Port       = 465;                                        // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above


$func = FonctionsMegaptera::GetFunct();
$pdo  = PdoMegaptera::getPdoMegaptera();

require("vue/v_entete.php");
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
                header("Location:index.php?uc=deconnexion");
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
}
include("vue/v_pied.php");

