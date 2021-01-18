
<form id="formulaire" method="post"  action="index.php?uc=menuSuper&action=confirmerModifierGroupe&code=<?php echo $code?>">
   <fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Modification d'un groupe</legend>
		<div class="row form-group" >
  			
		<P>	 
			<label for = "code">Code : </label>
			<input type = "text"  name = "code" size = "30" maxlength = "45" value ='<?php echo $code?>' disabled>
        </p>
		<P>
			<label for = "libelle">Libelle * :</label>
			<input type = "text"  name = "libelle" size = "30" maxlength = "45" value ='<?php echo $libelle?>' required>
        </p>
		<p>
		
			<label for = "operateur">Operateur * :</label>
			<input type = "text"  name = "operateur" size = "1" maxlength = "1"  value = '<?php echo $operateur ?>' required>
        </p>
		<p>
			<label for = "valeur">Valeur * :</label>
			<input type = "text"  name = "valeur" size = "1" maxlength = "1" value ='<?php echo $valeur?>' required>
        </p>
	    <P>
		</div>
		<div class="d-flex flex-md-row flex-sm-row flex-column justify-content-md-center justify-content-sm-center" id="Button">
      		<input type = "submit" value = "Valider" name = "valider">
			<input type = "reset" value = "Annuler" name = "annuler"> 
	    </div>
			
	</fieldset>
</form>
