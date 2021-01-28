<?php
if(!isset($_REQUEST['action']))
     $action = 'connexion';
else
	$action = $_REQUEST['action'];

switch($action)
{	
	case 'connexion':
	{
		include("vue/v_connexion.php");
		break;
	}
	
    case 'valider' :
	{
        $login = $_REQUEST['login'];
        $mdp = $_REQUEST['mdp'];
		
        $membre = $pdo->getInfosMembre($login,$mdp);

        if(!is_array($membre)){
			?><a id="Error"><?php echo "Login ou mot de passe incorrect";?><br></a><?php
      
            include("vue/v_connexion.php");
        }
        else 
        {
             if($membre['poste'] == "membre")
			 {  
				$_SESSION['poste']='menuMembre';
				$_SESSION['id']= $membre['id'];
				include("vue/v_menuMembre.php");
				
			 }
			else
			{
				if($membre['poste'] == "Admin")	
				{
				    $_SESSION['poste']='menuAdmin';
					$_SESSION['id'] = $membre['id'];
					include("vue/v_menuAdmin.php"); 	
			    }
			   else 
			    {
				   if ($membre['poste'] == "superAdmin")
				   {
				        $_SESSION['poste']='menuSuper';
					    $_SESSION['id']= $membre['id'];
					    include ("vue/v_menuSuperAdmin.php");
				   }
			 
				   else
				   {    
		            	?><a id="Error"><?php echo "Vous n'êtes pas autorisé";?><br></a><?php
      
						include("vue/v_connexion.php");
					
				   }
			   }
			}
		}
		break;
    } 
	
    case 'deconnexion':
	{
        $pdo->__destruction();
		session_destroy();
        include("vue/v_connexion.php");
		break;
	}

}
?>