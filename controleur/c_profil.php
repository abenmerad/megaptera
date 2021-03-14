<?php
if(!isset($_REQUEST['action']))
    $action = 'consulter';
else
    $action = $_REQUEST['action'];

switch($action)
{
    case 'consulter':
    {

        if(isset($_REQUEST['id']))
        {
            $unMembre           = $pdo -> getUnMembre($_REQUEST['id']);
            $lesObservations    = $pdo -> getObservationMembre($_REQUEST['id']);
            include('vue/v_profil.php');
        }
        else if(isset($_SESSION['id']))
        {
            $unMembre           = $pdo -> getUnMembre($_SESSION['id']);
            $lesObservations    = $pdo -> getObservationMembre($_SESSION['id']);
            include('vue/v_profil.php');
        }
        break;
    }
    default:
    {
        header('Location:index.php?uc=profil');
        break;
    }
}