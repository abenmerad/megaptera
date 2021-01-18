	
	
<fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Liste suppression des lieux</legend>
		<div class="row form-group" >
  		

		<table  align = "center" border = "2" cellpadding="15">
				<tr>
						<th>CODE  </th>
						<th>      LIEU          </th>
						<th>ORIENTATION LATITUDE</th>
						<th>ORIENTATION LONGITUDE</th> 
						<th>SUPPRESSION</th>
					
				</tr>
						

	
		<?php

			foreach( $lesLignes as $unLieu) 
			{
				$code = $unLieu['code'];
				$lieu = $unLieu['lieu'];
				$latitute=$unLieu['orientationLat'];
				$longitude = $unLieu['orientationLong'];
				?>	
				<tr>
						<td><?php echo $code ?></td>
						<td><?php echo $lieu ?></td>
						<td><center><?php echo $latitute ?></center></td>
						<td><center><?php echo $longitude ?></center></td> 
	
			<td><center><a href="index.php?uc=menuSuper&code=<?php echo $code ?>&action=confirmerSupprimerLieu" 
			onclick="return confirm('Voulez-vous vraiment supprimer ce Lieu ?');"> 
			<img src="images/supprimer.gif" TITLE="Supprimer"> </center></a></td>
			
				</tr>
						
					
					
		<?php			
			}
		?>
		</table>
</div>		
</fieldset>
