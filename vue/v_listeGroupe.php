<div id="Lieu">
     <h1> Liste des types de groupe</h1>
		<table width=100%>
				<tr>
						<th>CODE  </th>
						<th  width=40%>LIBELLE  </th>
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
<ul>
<li><a href="index.php?uc=menuSuper&action=ajouterGroupe">ajouter un type de groupe</a></li>
</ul>
</div		  
