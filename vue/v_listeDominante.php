<fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Liste des dominantes</legend>
		<div class="row form-group" >
		<table  align = "center" border = "2" cellpadding="15">

				<tr>
						<th>CODE  </th>
						<th >LIBELLE  </th>
					    <th>MODIFICATION</th>
				</tr>
		<?php
			foreach( $lesDominantes as $uneDominante) 
			{
				$id = $uneDominante['id'];
				$libelle = $uneDominante['libelle'];
			
			
				?>	
				<tr>
					<td><?php echo $id ?></td>
					<td ><?php echo $libelle?></td>
				
				
					<td><center><a href="index.php?uc=menuSuper&id=<?php echo $id ?>&action=modifierDominante"> 
			<img src="images/modifier.gif" TITLE="Modifier"> </a></center></td>
				</tr>				
		<?php			
			}
		?>
		</table>	
		</div>
<ul>
	<a href="index.php?uc=menuSuper&action=ajouterDominante"><h5><u>ajouter une dominante</u><h5></a>
</ul>

</fieldset>	  
