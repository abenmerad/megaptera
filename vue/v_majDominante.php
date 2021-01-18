
<form id="formulaire" method="post"  action="index.php?uc=menuSuper&action=confirmerModifierDominante&id=<?php echo $id?>">
   <fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Modification Dominante</legend>
		<div class="row form-group" >	
		
			<label for = "id">Identication</label>
                 <input type = "text"  name = "id" size = "30" maxlength = "45" value="<?php echo $id ?>" readonly = true>
			<label for = "libelle">Libelle  *:</label>
				<INPUT type="text" name='libelle' value='<?php echo $libelle ?>' required>
		</div>
						
		<div class="d-flex flex-md-row flex-sm-row flex-column justify-content-md-center justify-content-sm-center" id="Button">
      		<input type = "submit" value = "Valider" name = "valider">
			<input type = "reset" value = "Annuler" name = "annuler"> 
	    </div>
			
	</fieldset>
					
</FORM>
		
