<?php
$uc = $_SESSION['poste']; 
 ?>
 
<form id="formulaire" method="post"  action="index.php?uc=<?php echo $uc ?>&action=confirmerAjouterMembre">
       <fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Ajouter un membre</legend>
		<div class="row form-group"> 
	
			<P>
				<label for = "poste">Poste</label>
				<select name="poste" >
						<?php	if($_SESSION['poste'] == 'menuSuper')
									{?>
										<option value='superAdmin'>superAdmin</option>
										<option value='Admin'>Admin</option>
									
						<?php	    }?>
								
									  <option value= 'membre' selected>Membre</option>
								
								</select><br>
			</p>
			<p>	
				<label for = "name">Nom * : </label>
				<input type = "text"  name = "nom" value ='' size = "30" maxlength = "45" required >
			</P>
			<P>
				<label for = "prenom">Prenom  * :</label>
			   <input type = "text"  name = "prenom" value ='' size = "30" maxlength = "45" required>
			</P>
			<P>
				<label for = "login">Login <em>*</em></label>
				<input type = "text"  name = "login" value ='' size = "30" maxlength = "45" required>
			</P>
			<P>
				<label for = "mdp">Mot de passe <em>*</em></label>
				<input type = "mdp"  name = "mdp" value ='' size = "30" maxlength = "45" required >
			</P>
			 <P>
				<label for="email">E-mail <em>*</em></label>
				<input name ="mail" type="email" value ='' size = "30" maxlength = "45"  placeholder="xxxxxxxx@xxxx.com" required="" pattern="[a-zA-Z0-9.-]+@[a-zA-Z.-_]+.[a-zA-Z.]{2,15}">
			 </P>
			 <P>
				<label for = "number">Téléphone</label>
				<input name="tel" type="tel" value ='' size = "10" maxlength = "10" placeholder="0xxxxxxxxx" pattern="[0-9]{10}">
			 </p>
			
		</div>
		<div class="d-flex flex-md-row flex-sm-row flex-column justify-content-md-center justify-content-sm-center" id="Button">
      		<input type = "submit" value = "Valider" name = "valider">
			<input type = "reset" value = "Annuler" name = "annuler"> 
	    </div>
		</fieldset>
	
 </form>
