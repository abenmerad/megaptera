

		
<FORM id="formulaire" method="post" action='index.php?uc=menuSuper&action=confirmerModifierDominante&code='<?php echo $id ?>''>
	<FIELDSET>
		<center>
			<h1>Modification  Dominante</h1>
					
			<label for = "id">Identication</label>
                 <input type = "text"  name = "code" size = "30" maxlength = "45" readonly = true>
			<label for = "libelle">Libellé  *:</label>
				<INPUT type="text" name='libelle' value='<?php echo $libelle ?>' required>
						
				 <input type = "submit" value = "Valider" name = "valider">
				 <input type = "reset" value = "Annuler" name = "annuler">
					
		 </center>
	</FIELDSET> 
</FORM>
		
