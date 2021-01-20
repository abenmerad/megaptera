<?php
$action = $_REQUEST['action'];

switch ($action)
{
    case 'validerObser':
    {
        include('vues/v_ListeAValiderObservation.php');
    }
}