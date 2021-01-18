<fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Liste suppression des types groupe</legend>
		<div class="row form-group" >
  		

		<table  align = "center" border = "2" cellpadding="15">
	
				<tr>
						<th>CODE  </th>
						<th>LIBELLE  </th>
						<th>OPERATEUR</th>
						<th>VALEUR</th> 
					    <th>SUPPRESSION</th>
				</tr>
		<?php
			foreach( $lesGroupes as $unGroupe) 
			{
				$code = $unGroupe['code'];
				$libelle = $unGroupe['libelle'];
				$operateur=$unGroupe['operateur'];
				$valeur = $unGroupe['valeur'];
			
				?>	
				<tr>
					<td><?php echo $code ?></td>
					<td><?php echo $libelle?></td>
					<td><?php echo $operateur ?></td>
					<td><center><?php echo $valeur ?></center></td>
					
	
			<td><center><a href="index.php?uc=menuSuper&code=<?php echo $code ?>&action=confirmerSupprimerGroupe" 
			onclick="return confirm('Voulez-vous vraiment supprimer ce Lieu ?');"> 
			<img src="images/supprimer.gif" TITLE="Supprimer"> </center></a></td>
			
				</tr>
							
					
		<?php			
			}
		?>
		</table>
</div>		
</fieldset>