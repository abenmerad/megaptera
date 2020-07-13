<div id="Lieu">
     <h1> Liste des dominantes</h1>
		<table >
				<tr>
						<th>CODE  </th>
						<th >LIBELLE  </th>
					    <th>MODIFICATION</th>
				</tr>
		<?php
			foreach( $lesDominantes as $uneDominante) 
			{
				$code = $uneDominante['id'];
				$libelle = $uneDominante['libelle'];
			
			
				?>	
				<tr>
					<td><?php echo $code ?></td>
					<td ><?php echo $libelle?></td>
				
				
					<td><center><a href="index.php?uc=menuSuper&code=<?php echo $code ?>&action=modifierDominante"> 
			<img src="images/modifier.gif" TITLE="Modifier"> </a></center></td>
				</tr>				
		<?php			
			}
		?>
		</table>	
<ul>
<li><a href="index.php?uc=menuSuper&action=ajouterDominante">ajouter une dominante</a></li>
</ul>
</div		  
