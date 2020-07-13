
<form id="formulaire" method="post"  action="index.php?uc=menuSuper&action=confirmerAjouterGroupe">
        <fieldset>
			<h1 id="hh">Ajouter un groupe</h1>
			<div id="form1">
				
				 <p>
				<label for = "code">Code * :</label>
				<input type = "text"  name = "code" size = "30" maxlength = "45" placeholder = "Saisir code" required>
				</p>
				<p>
				<label for = "libelle">Libelle * :</label>
				<input type = "text"  name = "libelle" size = "30" maxlength = "45" placeholder = "Saisir le libellé" required >
				</p>
				<p>
				<label for = "operateur">Opérateur * :</label>
				<input type = "text"  name = "operateur" size = "1" maxlength = "1" placeholder = "Les operateurs valides sont '>','%' ou '='" required >
				</p>
				 <p>
				<label for = "valeur">Valeur * :</label>
				<input type = "text"  name = "operateur" size = "1" maxlength = "1" placeholder = "Saisir un nombre" required>
				</p>
				<P>
				<center>
				   <input type = "submit" value = "Valider" name = "valider">
				   <input type = "reset" value = "Annuler" name = "annuler">  
			   </center>
				</p>
			</div>
		</fieldset>
   </form>
