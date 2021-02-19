<?php
 $uc = $_SESSION['poste'];
 ?>
<form id="formulaire" method="post"  action="index.php?uc=<?php echo $uc ?>&action=confirmerModifierMembre&id=<?php echo $id ?>">
   <fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Modification d'un membre</legend>
		<div class="row form-group"> 
			<P> 
				<label for = "identifiant">Identifiant</label>
				<input type = "text"  name = "id" value ='<?php echo $id ?>' size = "30" maxlength = "45"  readonly="true">
            </p>
			<P>
				<label for = "poste">Poste</label>
				<input type = "text"  name = "poste" value ='<?php echo $poste ?>' size = "30" maxlength = "45"  readonly="true">
            </p>
			<p>
				<label for = "name">Nom </label>
				<input type = "text"  name = "nom" value ='<?php echo $nom ?>' size = "30" maxlength = "45" readonly="true">
             </p>
			 <P>
				<label for = "prenom">Prenom <em>*</em></label>
				<input type = "text"  name = "prenom" value ='<?php echo $prenom ?>' size = "30" maxlength = "45" required>
			</p>
			<P>
				<label for = "login">Login <em>*</em></label>
				<input type = "text"  name = "login" value ='<?php echo $login ?>' size = "30" maxlength = "45" required>
			</p>
			<P>
				<label for = "mdp">Mot de passe <em>*</em></label>
				<input type = "mdp"  name = "mdp" value ='<?php echo $mdp ?>' size = "30" maxlength = "45" required>
				<span id="msg"></span> 
            </p>
            <P>
				<label for="email">Email <em>*</em></label>
				<input name ="mail" type="mail" value ='<?php echo $mail ?>' size = "30" maxlength = "45"  placeholder="xxxxxxxx@xxxx.com" required="" pattern="[a-zA-Z]*@[a-zA-Z]*.[a-zA-Z]*"><br>
			</p>
			<p>
				<label for = "number">Téléphone<em>*</em></label>
				<input name="tel" type="tel"value ='<?php echo $tel ?>' size = "10" maxlength = "10" placeholder="06xxxxxxxx" pattern="[0-9]{10}"><br>
	        </p>
	
			</div>
	    	<div class="d-flex flex-md-row flex-sm-row flex-column justify-content-md-center justify-content-sm-center" id="Button">
      		<input type = "submit" value = "Valider" name = "valider">
			<input type = "reset" value = "Annuler" name = "annuler"> 
	      </div>
		</fieldset>
	
</form>
