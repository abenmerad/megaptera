<?php
 if($_SESSION['poste'] == 'menuSuper')
 {
	 $uc = "menuSuper";
 }
 if($_SESSION['poste'] == 'admin')
 {
	 $uc = "menuAdmin";
 }
 ?>
<form id="formulaire" method="post"  action="index.php?uc=<?php echo $uc ?>&action=confirmerAjouterMembre">
     <fieldset>
		
        <h1 id="hh">Ajouter un membre</h1>

		<div id="form1">
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
				<label for="email">Email <em>*</em></label>
				<input name ="mail" type="email" value ='' size = "30" maxlength = "45"  placeholder="xxxxxxxx@xxxx.com" required="" pattern="[a-zA-Z]*@[a-zA-Z]*.[a-zA-Z]*">
			 </P>
			 <P>
				<label for = "number">Téléphone</label>
				<input name="tel" type="tel" value ='' size = "10" maxlength = "10" placeholder="06xxxxxxxx" pattern="06[0-9]{8}">
			 </p>
			 <p>
				<center>
					<input type = "submit" value = "Valider" name = "valider"  onclick="validate()">
					 <span id="msg"></span> 

					<input type = "reset" value = "Annuler" name = "annuler"> 
				</center>
			</P>
		</div>
	  
	</fieldset>
 </form>
