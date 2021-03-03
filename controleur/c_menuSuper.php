<?php
if(!isset($_REQUEST['action']))
     $action = 'filtre';
else
	$action = $_REQUEST['action'];

switch($action)
{

	case 'validerObservation':
	{
	    $lesObservations = $pdo-> getObservationNonValide();
		require("vue/v_listeAValiderObservation.php");
		break;
	}

	case 'confirmerValiderUneObservation':
	{
        try {
            $pdo-> validerUneObservation($_REQUEST['code']);
            $_SESSION['reussite'] = "Observation validée avec succès.";
        }
        catch(Exception $e)
        {
            $_SESSION['erreurs'][] = "Une erreur est survenue lors de la validation de l'observation.";
        }
        header("Location:index.php?uc=" . $_SESSION['poste'] . "&action=validerObservation");
		break;
	}
	case 'supprimerObservation':
	{  
	    $lesObservations = $pdo-> getObservationNonValide();
		require("vue/v_listeSuppObservation.php");
		break;
	}
	case 'confirmerSupprimerObservation':
	{      
			$code = $_REQUEST['code'];
			$pdo -> supprimerObservation($code);	
			// supprimer également la photo ?
			$lesObservations = $pdo->getObservationNonValide();
	   	    include("vue/v_listeSuppObservation.php");
	      break;
	}
	case 'listeObservation':
	{
		$lesObservations = $pdo->getLesObservations();
		include("vue/v_listeObservations.php");
       	break;
	}

	case 'modifierObservation':
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
        $lesLieux = $pdo -> getLesLieux();
        $code = $_REQUEST['code'];
        $uneObservation = $pdo->getUneObservation($code);
        include("vue/v_majObservation.php");
        break;
    }

	case 'confirmerModifierObservation':
	{
        $code               = $_REQUEST['code'];
        $lieu               = $_REQUEST['Lieu'];
        $latOrientation     = $_POST['latOrientation'];
        $longOrientation    = $_POST['longOrientation'];
        $uneObservation     = $pdo -> getUneObservation($code);
        $rechercheCode      = $lieu . date("Y", strtotime($uneObservation['dateObservation']));
        $nbCaracteres       = strlen($rechercheCode);
        $info_img           = pathinfo($uneObservation['nomPhoto']);
        $num                = $pdo -> dernierCodeObs($rechercheCode);

        if (!is_null($num['Max']))
        {
            settype($num['Max'], "string");
            $longueur = strlen($num['Max']);
            $numero = substr($num['Max'],$nbCaracteres ,3);
            $numero = $numero + 1 ;
        }
        else
        {
            $numero = 1 ;
        }

        $nouveauCode        = $rechercheCode . $numero;
        $nouveauNomPhoto    = $nouveauCode . '.' . $info_img['extension'];
        $from               = $info_img['dirname'] . '/' . $info_img['basename'];
        $to                 =  'images/' . $lieu . '/' . $nouveauNomPhoto;

        chmod($from, 777);
        if(rename($from, $to))
        {
            $longitude =  $longOrientation . " " . $_POST['DegresLong'] . "°" . $_POST['MinutesLong'] . "'" . $_POST['SecondesLong'] . '"';
            $latitude = $latOrientation . " " . $_POST['DegresLat'] . "°" . $_POST['MinutesLat'] . "'" . $_POST['SecondesLat'] . '"';
            $pdo -> modifierObservation($code, $lieu, addslashes($latitude), addslashes($longitude), $nouveauCode, $to);
            $_SESSION['reussite'] = "Observation modifiée avec succès.";
        }
        else
        {
            $_SESSION['erreurs'][] = "Une erreur est survenue lors de la modification de l'observation. Veuillez ressayez.";
        }
        header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=validerObservation");
        break;
	}
	// gestion des lieux
	case 'listeLieu':
	{
		$lesLieux = $pdo->getLesLieux();
		include("vue/v_listeLieu.php");
       	break;
	}
	case 'ajouterLieu':
	{
		include("vue/v_ajouterLieu.php");
		break;
	}
    case 'confirmerAjouterLieu':
	{
		$lieu       = htmlspecialchars($_REQUEST['lieu']);
		$latitude   = $_REQUEST['latitude'];
		$longitude  = $_REQUEST['longitude'];
        $code       = strtoupper(substr($lieu, 0, 3));

        if($pdo -> verifierLieu($code) >= 1)
        {
            $_SESSION['erreurs'][] = "Il existe déjà un lieu avec le code <b>\"$code\"</b>";
            header('Location: index.php?uc=' . $_SESSION['poste'] . '&action=ajouterLieu&code=' . $code);
        }
        else if($longitude == null && $latitude == null)
        {
            $_SESSION['erreurs'][] = "Un champ n'a pas été rempli.";
            header('Location: index.php?uc=' . $_SESSION['poste'] . '&action=ajouterLieu&code=' . $code);
        }
        else
        {
            $pdo -> ajouterLieu($code, $lieu, $latitude, $longitude);
            $_SESSION['reussite'] = "Le lieu a bien été ajouté.";
            header('Location:index.php?uc=' . $_SESSION['poste'] . '&action=listeLieu');
        }
	    break;
	}
	
	case 'modifierLieu':
	{  
        $code       = $_REQUEST['code'];
        $unLieu     = $pdo->getUnLieu($code);
        $lieu       = $unLieu['lieu'];
        $latitude   = $unLieu['orientationLat'];
        $longitude  = $unLieu['orientationLong'];
        include("vue/v_majLieu.php");
        break;
    }

	case 'confirmerModifierLieu':
	{
        $code           = htmlspecialchars($_REQUEST['code']);
        $lieu           = htmlspecialchars($_REQUEST['lieu']);
        $latitude       = $_REQUEST['latitude'];
        $longitude      = $_REQUEST['longitude'];
        $nouveauCode    = strtoupper(substr($lieu, 0, 3));

        if($pdo -> verifierLieu($nouveauCode) >= 1)
        {
            $_SESSION['erreurs'][] = "Il existe déjà un lieu avec le code <b>\"$nouveauCode\"</b>";
            header('Location: index.php?uc=' . $_SESSION['poste'] . '&action=ajouterLieu&code=' . $code);
        }
        else if($longitude == null && $latitude == null)
        {
            $_SESSION['erreurs'][] = "Un champ n'a pas été rempli.";
            header('Location: index.php?uc=' . $_SESSION['poste'] . '&action=ajouterLieu&code=' . $code);
        }
        else
        {
            $pdo -> modifierLieu($code, $nouveauCode, $lieu, $latitude, $longitude);
            $_SESSION['reussite'] = "Le lieu a bien été modifié.";
            header('Location:index.php?uc=' . $_SESSION['poste'] . '&action=listeLieu');
        }
        break;
	}

	case 'supprimerLieu':
	{
        $code               = $_REQUEST['code'];
        $lesObservations    = $pdo -> getLesObservationsParLieu($code);
        $unLieu             = $pdo->getUnLieu($code);
        if(count($lesObservations) != 0)
        {
            $_SESSION['erreurs'][] = "Il existe <b>" . count($lesObservations) . "</b> observation(s) liée(s) à ce lieu. Merci de bien vouloir supprimer ou modifier cette ou ces observation(s).";
            header('Location:index.php?uc=' . $_SESSION['poste'] . '&action=listeLieu');
        }
        else
        {
            $pdo -> supprimerLieu($code);
            $_SESSION['reussite'] = "Le lieu a bien été supprimé.";
            header('Location:index.php?uc=' . $_SESSION['poste'] . '&action=listeLieu');
        }
        break;
	}
	
	/* gestion des dominante */
    case 'ajouterDominante':
	{
		include("vue/v_ajouterDominante.php");
		break;
	}
	
    case 'confirmerAjouterDominante':
	{
        $libelle            = htmlspecialchars(strtoupper($_REQUEST['libelle']));
        $correspondanceDom  = $pdo -> getUneDominanteParLibelle($libelle);

        if(!empty($correspondanceDom) && count($correspondanceDom) != 0)
        {
            $_SESSION['erreurs'][] = "Il existe déjà une couleur ayant le libellé <b>\"$libelle\"</b>.";
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=ajouterDominante");
        }
        else
        {
            $_SESSION['reussite'] = "Couleur dominante ajouté avec succès.";
            $pdo -> ajouterDominante($libelle);
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=listeDominante");
        }
        break;
	}
	case 'listeDominante':
	{
        $lesDominantes = $pdo->getLesDominantes();
		include("vue/v_listeDominante.php");
		break;
	}
	
    case 'modifierDominante':
	{
        $uneDominante   = $pdo->getUneDominante($_REQUEST['id']);
        include("vue/v_majDominante.php");
        break;
    }

	case 'confirmerModifierDominante':
	{
        $id                 = htmlspecialchars($_REQUEST['id']);
        $libelle            = htmlspecialchars(strtoupper($_REQUEST['libelle']));
        $correspondanceDom  = $pdo -> getUneDominanteParLibelle($libelle);

        if(!empty($correspondanceDom) && count($correspondanceDom) != 0)
        {
            $_SESSION['erreurs'][] = "Il existe déjà une couleur ayant le libellé <b>\"$libelle\"</b>.";
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=modifierDominante&id=" . $id);
        }
        else
        {
            $_SESSION['reussite'] = "Couleur dominante modifié avec succès.";
            $pdo -> modifierDominante($id,$libelle);
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=listeDominante");
        }
		break;
	}

	case 'supprimerDominante':
	{      
        $id                 = $_REQUEST['idDominante'];
        $correspondanceDom  = $pdo -> getLesObservationsParDominante($id);

        if(count($correspondanceDom) != 0)
        {
            $_SESSION['erreurs'][] = "Il existe <b>" . count($correspondanceDom) . "</b> observation(s) liée(s) à cette couleur. Merci de bien vouloir supprimer ou modifier cette ou ces observation(s).";
        }
        else
        {
            $_SESSION['reussite'] = "Couleur supprimé avec succès.";
            $pdo -> supprimerDominante($id);
        }
        header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=listeDominante");
        break;
	}
	
	/* gestion des membre */
	
	case 'ajouterMembre':
	{
        $lesPostes  = $pdo -> getLesPostesMembres();
		include("vue/v_ajouterMembre.php");
		break;
	}
	
    case 'confirmerAjouterMembre':
	{
        $login          = htmlspecialchars($_REQUEST['login']);
        $mdp            = bin2hex(openssl_random_pseudo_bytes(4));
        $poste          = htmlspecialchars($_REQUEST['poste']);
        $nom            = htmlspecialchars($_REQUEST['nom']);
        $prenom         = htmlspecialchars($_REQUEST['prenom']);
        $mail           = htmlspecialchars($_REQUEST['mail']);
        $tel            = htmlspecialchars($_REQUEST['tel']);
        $correspondance = $pdo -> checkPresenceMembre($nom, $prenom, $login, $tel, $mail);

        if(count($correspondance) != 0)
        {
            foreach($correspondance as $corr)
            {
                if($login == $corr['login'])
                {
                    $_SESSION['erreurs'][] = "Un membre possède déjà ce login.";
                }
                if($nom == $corr['nom'] && $prenom == $corr['prenom'])
                {
                    $_SESSION['erreurs'][] = "Le membre <b>" . $nom . " " . $prenom . "</b> existe déjà dans la base de données.";
                }
                if($tel == $corr['tel'])
                {
                    $_SESSION['erreurs'][] = "Un membre possède déjà ce numéro de téléphone.";
                }
                if($mail == $corr['mail'])
                {
                    $_SESSION['erreurs'][] = "Un membre possède déjà ce mail.";
                }
            }
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=ajouterMembre");
        }
        else
        {
            $pdo -> inscriptionMembre($nom, $prenom, $login, $mdp, $tel, $mail, $poste);
            $_SESSION['reussite'] = "Membre ajouté avec succès.";
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=listeMembre");
        }
        break;
	}
	case 'listeMembre':
	{
	    $lesMembres = $pdo->getLesMembres();
		include("vue/v_listeMembre.php");
		break;
	}
	
    case 'modifierMembre':
	{
        $unMembre   = $pdo -> getUnMembre($_REQUEST['id']);
        $lesPostes  = $pdo -> getLesPostesMembres();
        include("vue/v_majMembre.php");
        break;
    }

	case 'confirmerModifierMembre':
	{
        $id                 = htmlspecialchars($_REQUEST['id']);
        $login              = htmlspecialchars($_REQUEST['login']);
        $nom                = htmlspecialchars($_REQUEST['nom']);
        $prenom             = htmlspecialchars($_REQUEST['prenom']);
        $mail               = htmlspecialchars($_REQUEST['mail']);
        $tel                = htmlspecialchars($_REQUEST['tel']);
        $poste              = htmlspecialchars($_REQUEST['poste']);
        $membre             = $pdo -> getUnMembre($id);
        $correspondance     = $pdo -> checkPresenceMembre($nom, $prenom, $login, $tel, $mail);

        if(count($correspondance) != 0)
        {
            foreach($correspondance as $corr)
            {
                if($login == $corr['login'])
                {
                    $_SESSION['erreurs'][] = "Un membre possède déjà ce login.";
                }
                if($nom == $corr['nom'] && $prenom == $corr['prenom'])
                {
                    $_SESSION['erreurs'][] = "Le membre <b>" . $nom . " " . $prenom . "</b> existe déjà dans la base de données.";
                }
                if($tel == $corr['tel'])
                {
                    $_SESSION['erreurs'][] = "Un membre possède déjà ce numéro de téléphone.";
                }
                if($mail == $corr['mail'])
                {
                    $_SESSION['erreurs'][] = "Un membre possède déjà ce mail.";
                }
            }
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=modifierMembre&id=" . $id);
        }
        else
        {
            $pdo -> modifierMembre($id, $nom, $prenom, $login, $tel, $mail, $poste, $membre);
            $_SESSION['reussite'] = "Membre modifié avec succès.";
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=listeMembre");
        }
        break;
	}

    case 'supprimerMembre':
    {
        $id             = $_REQUEST['id'];
        $nbObservation  = count($pdo->getLesObservationsParMembre($id));
        $membre         = $pdo->getUnMembre($id);

        if ($nbObservation == 0)
        {
            $pdo->suppressionMembre($id);
            $_SESSION['reussite'] = "Le membre a été supprimé avec succès.";
        }
        else
        {
            $_SESSION['erreurs'][] = "Ce membre ne peut être supprimé, car <b> $nbObservation </b> observation(s) lui sont liée(s).";
        }
        header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=listeMembre");
        break;
    }

	/* les types de groupe */
	
	case 'ajouterGroupe':
	{
		include("vue/v_ajouterGroupe.php");
		break;
	}

	case 'confirmerAjouterGroupe':
	{
        $libelle        = htmlspecialchars($_POST['libelle']);
        $operateur      = $_POST['operateur'];
        $valeur         = $_POST['valeur'];
        $code           = "";

        foreach(explode(" ", $libelle) as $sequence) //Récupère la première lettre de chaque sequence pour former le nouveau code - Sequence = chaque mots séparés entre eux par un espace
        {
            $code .= strtoupper($sequence[0]);
        }

        $correspondanceGrp = $pdo -> getUnGroupe($code);

        if(!empty($pdo -> getUnGroupe($code)) && $correspondanceGrp['code'] == $code)
        {
            $_SESSION['erreurs'][] = "Le groupe <b>\"" . $correspondanceGrp['libelle'] . "\"</b> possède déjà le code <b>\"" . $correspondanceGrp['code'] . "\"</b>";
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=ajouterGroupe");
        }
        else
        {
            $pdo -> ajouterGroupe($code, $libelle, $operateur, intval($valeur));
            $_SESSION['reussite'] = "Groupe ajouté avec succès.";
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=listeGroupe");
        }
        break;
	}
	case 'listeGroupe':
	{
	    $lesGroupes = $pdo -> getLesGroupes();
		include("vue/v_listeGroupe.php");
		break;
	}
	
    case 'modifierGroupe':
	{  
        $code       = $_REQUEST['code'];
        $unGroupe   = $pdo->getUnGroupe($code);
        include("vue/v_majGroupe.php");
        break;
    }

	case 'confirmerModifierGroupe':
	{
        $code           = $_GET['code'];
        $unGroupe       = $pdo -> getUnGroupe($code);
        $libelle        = (empty($_POST['libelle'])) ? $unGroupe['libelle'] : $_POST['libelle'];
        $operateur      = $_POST['operateur'];
        $valeur         = $_POST['valeur'];
        $nouveauCode    = "";

        foreach(explode(" ", $libelle) as $sequence) //Récupère la première lettre de chaque sequence pour former le nouveau code - Sequence = chaque mots séparés entre eux par un espace
        {
            $nouveauCode .= strtoupper($sequence[0]);
        }

        $correspondanceGrp = $pdo -> getUnGroupe($nouveauCode);

        if(!empty($pdo -> getUnGroupe($nouveauCode)) && $correspondanceGrp['code'] == $code && $correspondanceGrp['libelle'] != $libelle)
        {
            $_SESSION['erreurs'][] = "Un groupe ayant le code <b>" . $nouveauCode . "</b> existe déjà.";
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=modifierGroupe&code=" . $code);
        }
        else
        {
            $pdo -> modifierGroupe($code, $nouveauCode, $libelle, $operateur, intval($valeur));
            $_SESSION['reussite'] = "Groupe modifié avec succès.";
            header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=listeGroupe");
        }
        break;
	}
	case 'supprimerGroupe':
	{      
        $code               = $_REQUEST['code'];
        $correspondanceGrp  = $pdo -> getLesObservationsParGroupe($code);

        if(count($correspondanceGrp) != 0)
        {
            $_SESSION['erreurs'][] = "Il existe <b>" . count($correspondanceGrp) ."</b> observation(s) liée(s) à ce groupe. Merci de modifier ou de supprimer cette ou ces observation(s) afin de supprimer ce groupe";
        }
        else
        {
            $pdo -> supprimerGroupe($code);
            $_SESSION['reussite'] = "Groupe supprimé avec succès.";
        }
        header("Location: index.php?uc=" . $_SESSION['poste'] . "&action=listeGroupe");
        break;
	}
    default:
    {
        header('Location:index.php?uc=observation&action=rechercheObservations');
    }
}