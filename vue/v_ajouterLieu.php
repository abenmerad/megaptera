<FORM id="formulaire" method="post" action='index.php?uc=menuSuper&action=confirmerAjouterLieu'>

	<FIELDSET>	
		<h1 id="hh">Ajouter un lieu</h1>
		<div id="form1">
			<p>
				<label for="code">Code   *:</label>
				<INPUT type="text" id="code" name="code" size = "4" maxlength = "5" value='' required/><br>
			</p>
			<p>
				<label for="lieu">Lieu  *:</label>
				<INPUT type="text" id="lieu" name="lieu" size = "50" maxlength = "100" value=''required /><br>							
			</p>
			<p>
				<label for="latitude">Latitude :</label>
					<select name="latitude" >
						<option value= 'N' selected>N</option>
						<option value='S'>S</option>
					</select><br>
            </p>  
			<P>
				<label for="longitude">Longitude :</label>
					<select id="longitude" name="longitude">
						<option value='E' selected>E</option>
						<option value='O'>O</option>
					</select>
			</p>
			<p>
				<center>
					<input type = "submit" value = "Valider" name = "valider">
					<input type = "reset" value = "Annuler" name = "annuler"> 
			     </center>
		</div>
	</FIELDSET>
	
</FORM>
		