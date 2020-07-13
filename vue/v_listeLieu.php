<div id="Lieu">
     <h1> Liste des lieux</h1>
		<table >
				<tr>
						<th>  CODE  </th>
						<th>  LIEU  </th>
						<th>ORIENTATION LATITUDE</th>
						<th>ORIENTATION LONGITUDE</th> 
						<th>MODIFIER</th>
					
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
						<td><center><a href="index.php?uc=menuSuper&code=<?php echo $code ?>&action=modifierLieu"> 
			<img src="images/modifier.gif" TITLE="Modifier"> </a></center></td>
				</tr>
					
		<?php			
			}
		?>
		</table>
			
<ul>
<li><a href="index.php?uc=menuSuper&action=ajouterLieu ">ajouter un lieu </a></li>
</ul>
</div		  
