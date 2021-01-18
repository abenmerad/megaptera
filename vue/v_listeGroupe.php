<fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Liste pour modification les groupes</legend>
		<div class="row form-group" >
  		

		<table  align = "center" border = "2" cellpadding="15">

				<tr>
						<th>CODE  </th>
						<th >LIBELLE  </th>
						<th>OPERATEUR</th>
						<th>VALEUR</th> 
					    <th>MODIFICATION</th>
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
					<td width=40%  ><?php echo $libelle?></td>
					<td><center><?php echo $operateur ?></center></td>
					<td><center><?php echo $valeur ?></center></td>
				
					<td><center><a href="index.php?uc=menuSuper&code=<?php echo $code ?>&action=modifierGroupe"> 
			<img src="images/modifier.gif" TITLE="Modifier"> </a></center></td>
				</tr>				
		<?php			
			}
		?>
		</table>	
	</div>
<ul>
  <a href="index.php?uc=menuSuper&action=ajouterGroupe"><h5><u>ajouter un type de groupe</u></h5></a>
</ul>
</fieldset>	  
