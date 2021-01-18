
<form id="formulaire" method="post"  action="index.php?uc=menuSuper&action=confirmerAjouterGroupe">
       <fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Ajouter un groupe</legend>
		<div class="row form-group" >
  			
				 <p>
				<label for = "code">Code * :</label>
				<input type = "text"  name = "code" size = "3" maxlength = "3" placeholder = "Saisir code" required>
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
				<input type = "text"  name = "valeur" size = "1" maxlength = "1" placeholder = "Saisir un nombre de 1 à 9" required>
				</p>
				<P>
		</div>
		<div class="d-flex flex-md-row flex-sm-row flex-column justify-content-md-center justify-content-sm-center" id="Button">
      		<input type = "submit" value = "Valider" name = "valider">
			<input type = "reset" value = "Annuler" name = "annuler"> 
	    </div>
			
			
		</fieldset>
   </form>
