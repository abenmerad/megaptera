<fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Liste suppression des dominantes</legend>
		<div class="row form-group" >
		<table  align = "center" border = "2" cellpadding="15">

				<tr>
						<th>  CODE  </th>
						<th>  DOMINANTE  </th>				
						<th>SUPPRESSION</th>				
				</tr>

		<?php

			foreach( $lesDominantes as $uneDominante) 
			{
				$id = $uneDominante['id'];
				$libelle = $uneDominante['libelle'];
			
				?>	
				<tr>
						<td><center><?php echo $id ?></center></td>
						<td><center><?php echo $libelle ?></center></td> 
	
			<td><center><a href="index.php?uc=menuSuper&id=<?php echo $id ?>&action=confirmerSupprimerDominante" 
			onclick="return confirm('Voulez-vous vraiment supprimer cette dominante ?');"> 
			<img src="images/supprimer.gif" TITLE="Supprimer"> </center></a></td>
			
				</tr>
			
		<?php			
			}
		?>
		</table>
</div>		
</fieldset>