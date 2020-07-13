<?php
 if($_SESSION['poste'] == 'menuSuper')
 {
	 $uc = "menuSuper";
 }
 if($_SESSION['poste'] == 'admin')
 {
	 $uc = "menuAdmin";
 }
 echo $_SESSION['poste'];
 ?>
<form id="formulaire" method="post"  action="index.php?uc=<?php echo $uc ?>&action=confirmerModifierMembre&id=<?php echo $id ?>">
    <fieldset>
		
        <h1 id="hh">Modifier un membre</h1>
		<div id="form1">
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
				<label for = "prenom">Prenom ></label>
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
				<label for = "number">Téléphone</label>
				<input name="tel" type="tel"value ='<?php echo $tel ?>' size = "10" maxlength = "10" placeholder="06xxxxxxxx" pattern="06[0-9]{8}"><br>
	        </p>
		    <p>
			<center>
				<input type = "submit" value = "Valider" name = "valider"  onclick="validate()>
				<input type = "reset" value = "Annuler" name = "annuler"> 
			</center>
			</p>
		</div>
	</fieldset>
</form>
