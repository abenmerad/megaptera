<?php
if(!isset($_REQUEST['action']))
    $action = 'rechercheObservations';
else
    $action = $_REQUEST['action'];

switch($action)
{
    case 'ajouter':
    {
        if(isset($_GET['codeLieu']))
        {
            $unLieu = $pdo -> getUnLieu($_GET['codeLieu']);
            die($unLieu['orientationLat'] . $unLieu['orientationLong']);
        }
        if(isset($_GET['codeGrp']))
        {
            $unGroupe = $pdo -> getUnGroupe($_GET['codeGrp']);
            die($unGroupe['operateur'] . $unGroupe['valeur']);
        }
        $lesLieux       = $pdo -> getLesLieux();
        $lesDominantes  = $pdo -> getLesDominantes();
        $lesGroupes     = $pdo -> getLesGroupes();
        include("vue/v_ajouterObservation.php");
        break;
    }
    case 'rechercheObservations':
    {
        $lesEtatsObservations   = $pdo -> getLesEtatsObservation();
        $lesGroupes             = $pdo -> getLesGroupes();
        $lesLieux               = $pdo -> getLesLieux();
        $lesDominantes          = $pdo -> getLesDominantes();
        include("vue/v_rechercheObservations.php");
        break;
    }
    case 'lesObservations':
    {
        $couleur                = $_POST['couleurObs'];
        $caudale                = $_POST['caudaleObs'];
        $papillon               = $_POST['papillonObs'];
        $minIndividus           = $_POST['minIndividus'];
        $maxIndividus           = $_POST['maxIndividus'];
        $annee                  = $_POST['anneeObs'];
        $groupe                 = $_POST['groupeObs'];
        $lieu                   = $_POST['lieuObs'];
        $donnees                = $_REQUEST;
        $lesEtatsObservations   = $pdo -> getLesEtatsObservation();
        $lesGroupes             = $pdo -> getLesGroupes();
        $lesLieux               = $pdo -> getLesLieux();

        if($minIndividus != null && $maxIndividus != null && $minIndividus > $maxIndividus)
        {
            $_SESSION['erreurs'][] = "Le nombre d'individus minimum ne peut pas être supérieur au nombre d'individus maximum.";
            header("Location:index.php?uc=menuMembre&action=rechercheMesObservations");
        }
        else if($minIndividus != null && $maxIndividus == null)
            $maxIndividus = 25; // On met la valeur au max
        else if($minIndividus == null && $maxIndividus != null)
            $minIndividus = 0; // On met la valeur au min
        else if($minIndividus == null && $maxIndividus == null)
            $minIndividus = 0;
        $maxIndividus = 25;

        $lesObservations  = $pdo -> getLesObservationsParFiltre($_SESSION['id'], $annee, $groupe, $lieu, $couleur, $caudale, $papillon, $minIndividus, $maxIndividus);

        if(count($lesObservations) != 0)
        {
            include("vue/v_rechercheObservations.php");
            include("vue/v_lesObservations.php");
        }
        else
        {
            $_SESSION['erreurs'][] = "Aucun resultat trouvé pour cette recherche.";
            header("Location:index.php?uc=menuMembre&action=rechercheMesObservations");
        }
        break;
    }
    case 'consultation':
    {
        $monObservation = $pdo -> getUneObservation($_REQUEST['id']);
        $img_obs        = explode(";", $monObservation['nomPhoto']);
        include("vue/v_consultation.php");
        break;
    }
    case 'export':
    {
        $annee              = $_REQUEST['annee'];
        $groupe             = $_REQUEST['groupe'];
        $lieu               = $_REQUEST['lieu'];
        $couleur            = $_REQUEST['couleur'];
        $caudale            = $_REQUEST['caudale'];
        $papillon           = $_REQUEST['papillon'];
        $min                = $_REQUEST['min'];
        $max                = $_REQUEST['max'];
        $keys               = [];

        if(empty($min))
            $min = 0;
        if(empty($max))
            $max = 25;

        $lesObservations    = $pdo -> getLesObservationsAExporte($_SESSION['id'], $annee, $groupe, $lieu, $couleur, $caudale, $papillon, $min, $max);

        foreach($lesObservations[0] as $k => $obs)
        {
            $keys[] = $k;
        }
        $func->creationCSV($lesObservations, $keys);
        break;
    }
    case 'confirmer':
    {
        $comportementObservation = htmlspecialchars($_POST['Comportement']);
        $commentaireObservation  = htmlspecialchars($_POST['Description']);
        $lieuInfo                = htmlspecialchars($_POST['LieuAutre']);
        $lieuObservation         = $_POST['Lieu'];
        $heureDebut              = date($_POST['HeureDebut']);
        $heureFin                = date($_POST['HeureFin']);
        $couleurDominante        = $_POST['Dominante'];
        $nbIndividu              = $_POST['NombreIndividu'];
        $typeCaudale             = $_POST['Caudale'];
        $typeGroupe              = $_POST['Groupe'];
        $aPapillon               = $_POST['Papillon'];
        $dateObservation         = $_POST['DateObservation'];
        $donnees                 = $_REQUEST;
        $monLieu                 = $pdo->getUnLieu($_POST['Lieu']);
        $today                   = date('Y-m-d', time());
        $img_upload              = [];
        $repertoire              = "";

        if(!isset($_POST['latOrientation']) || !isset($_POST['longOrientation']))
        {
            $_SESSION['erreurs'][] = "Aucune position n'a été indiqué.";
        }
        else
        {
            $latOrientation  = $_POST['latOrientation'];
            $longOrientation = $_POST['longOrientation'];
        }
        foreach($_FILES['nomImg']['error'] as $k => $error)
        {
            switch ($error)
            {
                case 0:
                {
                    $img_upload[] = ['name' => $_FILES['nomImg']['name'][$k], 'tmp_name' => $_FILES['nomImg']['tmp_name'][$k], 'type' => $_FILES['nomImg']['type'][$k]];
                    break;
                }
                case 1:
                {
                    $_SESSION['erreurs'][] = $_FILES['nomImg']['name'][$k] . " : L'image est trop lourde pour être téléchargée.";
                    break;
                }
                case 4:
                {
                    $_SESSION['erreurs'][] = "Aucune image n'a été ajouté.";
                    break;
                }
                default:
                {
                    $_SESSION['erreurs'][] = $_FILES['nomImg']['name'][$k] . " : Une erreur est survenue lors du téléchargement. Ressayez.";
                    break;
                }
            }
        }
        if (!empty($lieuObservation))
        {
            if ($lieuObservation == "Autre" && empty($lieuInfo))
                $_SESSION['erreurs'][] = "Les informations du lieu ne sont pas remplis.";
        }
        else
        {
            $_SESSION['erreurs'][] = "Veuillez choisir un lieu d'observation.";
        }

        if (empty($heureDebut) || empty($heureFin))
            $_SESSION['erreurs'][] = "Veuillez entrer une heure de début et de fin.";
        else if ($heureDebut > $heureFin)
            $_SESSION['erreurs'][] = "L'heure du début d'observation ne peut être supérieure à l'heure de fin.";

        if (empty($dateObservation))
            $_SESSION['erreurs'][] = "Aucune date d'observation n'a été entrée.";
        else if ($dateObservation > $today)
            $_SESSION['erreurs'][] = "La date d'observation ne peut être supérieure à la date du jour.";

        if (empty($couleurDominante))
            $_SESSION['erreurs'][] = "Veuillez selectionner une dominante.";

        if (empty($typeCaudale))
            $_SESSION['erreurs'][] = "Veuillez selectionner un type de caudale.";

        if (empty($aPapillon))
            $_SESSION['erreurs'][] = "Veuillez selectionner un papillon.";

        if (empty($typeGroupe))
            $_SESSION['erreurs'][] = "Veuillez selectionner un type de groupe.";

        if (empty($nbIndividu))
            $_SESSION['erreurs'][] = "Le nombre d'individus ne peut être nul.";

        if (!empty($_SESSION['erreurs']))
        {
            $lesLieux           = $pdo->getLesLieux();
            $lesDominantes      = $pdo->getLesDominantes();
            $lesGroupes         = $pdo->getLesGroupes();
            $_SESSION['data']   = $_REQUEST;
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=ajouter");
        }
        else
        {
            $rechercheCode      = $lieuObservation . date("Y", strtotime($dateObservation));
            $nbCaracteres       = strlen($rechercheCode);
            $num                = $pdo->dernierCodeObs($rechercheCode);

            if (!is_null($num['Max'])) {
                settype($num['Max'], "string");
                $numero         = substr($num['Max'], $nbCaracteres, 3);
                $numero         = $numero + 1;
            }
            else
            {
                $numero = 1;
            }

            $codeObservation    = $rechercheCode . $numero;
            $latitude           = $latOrientation  . " " . $_POST['DegresLong'] . "°" . $_POST['MinutesLong'] . "'" . $_POST['SecondesLong'] . '"';
            $longitude          = $longOrientation . " " . $_POST['DegresLat']  . "°" . $_POST['MinutesLat']  . "'" . $_POST['SecondesLat']  . '"';
            $auteur             = $_SESSION['id'];
            $chemin             = 'images/' . $lieuObservation . '/' . $codeObservation;
            echo $chemin;
            if(mkdir($chemin, 0700))
            {
                foreach($img_upload as $k => $img)
                {
                    $nomPhoto = $codeObservation . '_' . $k . '.' . explode("/", $img['type'])[1];
                    if($k != 0)
                        $repertoire .= ";" . $nomPhoto;
                    else
                        $repertoire .= $nomPhoto;
                    move_uploaded_file($img['tmp_name'], $chemin . '/' . $nomPhoto);
                }
                $ajout = $pdo -> ajouterObservation($codeObservation, $repertoire, $lieuObservation, $lieuInfo, $heureDebut, $heureFin, $dateObservation, addslashes($latitude), addslashes($longitude), $auteur, (int)$couleurDominante, $aPapillon, (int)$nbIndividu, (int)$typeCaudale, $typeGroupe, $commentaireObservation, $comportementObservation);
                header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=rechercheMesObservations");
            }
        }
        break;
    }
    default:
    {
        header('Location:index.php');
    }
}