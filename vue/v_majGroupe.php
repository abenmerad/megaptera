
<form id="formulaire" method="post"  action="index.php?uc=menuSuper&action=confirmerModifierGroupe$code=<?php $code ?>">
    <fieldset>
		<h1 id="hh">Modifier un groupe</h1>
		<div id="form1">
		<P>	 
			<label for = "code">Code</label>
			<input type = "text"  name = "code" size = "30" maxlength = "45" readonly = true>
        </p>
		<P>
			<label for = "libelle">Libelle * :</label>
			<input type = "text"  name = "libelle" size = "30" maxlength = "45" value ='<?php echo $libelle?>' required>
        </p>
		<p>
			<label for = "operateur">Opérateur * :</label>
			<input type = "text"  name = "operateur" size = "1" maxlength = "1"  value = '<?php echo $operateur ?>' required>
        </p>
		<p>
			<label for = "valeur">Valeur * :</label>
			<input type = "text"  name = "valeur" size = "1" maxlength = "1" value ='<?php echo $valeur?>' required>
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
