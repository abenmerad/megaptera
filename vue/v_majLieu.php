	
<FORM id="formulaire" method="post" action='index.php?uc=menuSuper&action=confirmerModifierLieu&code=<?php echo $code ?>'>
	<FIELDSET>		
        <h1 id="hh">Modifier lieu</h1>
		<div id="form1">
			<P>	  
				<label for="code">Code : </label>
				<INPUT type="text" id="code" name="code" size = "4" maxlength = "5" value='<?php echo $code ?>' readOnly = true/><br>
			</p>
			<P>			
				<label for="lieu">Lieu * :</label>
				<INPUT type="text" id="lieu" name="lieu" size = "50" maxlength = "100" value='<?php echo $lieu ?>' required/><br>
			</p>	
			<p>	
			    <label for="latitude">Latitude :</label>
				<select id="latitude" name="latitude" value = '<?php echo $latitude ?>' >
					<option value='<?php echo $latitude ?>' selected><?php echo $latitude?></option>;
			<?php	if($latitude == 'S')
					{?>
						<option value= 'N'>N</option>
			<?php	}
					else
					{?>
						<option value= 'S'>S</option>
			<?php
					} ?>
				</select><br>
             </p>    	
			<p>	
				<label for="longitude">Longitude :</label>
				<select id="longitude" name="longitude" >
				    <option value='<?php echo $longitude ?>'selected><?php echo $longitude ?></option>;
			<?php	if($longitude == 'O')
					{?>
					<option value= 'E' >E</option>
			<?php	}
					else
					{?>
			    	<option value= 'O' >O</option>
					<?php
					} ?>
				</select>
			</p>
			<p>
				<center>
		
					<input type = "submit" value = "Valider" name = "Valider">
					<input type = "reset" value = "Annuler" name = "annuler"> 
			    </center>
			</p>
		</div>
	</FIELDSET>	
</FORM>
	
		
					
       
                  
