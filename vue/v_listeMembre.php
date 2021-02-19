<fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Liste des membres</legend>
		<div class="row form-group text-center" >
		<table  align = "center" border = "2" cellpadding="5">

				<tr>
						<th>CODE</th>
						<th>NOM</th>
						<th>PRENOM</th>
						<th>LOGIN</th> 
						<th>MDP</th>
						<th>TEL</th>
						<th>MAIL</th>
						<th>POSTE</th>
					    <th>MODIFICATION</th>
				</tr>
		<?php
			foreach( $lesLignes as $unMembre) 
			{
				$id = $unMembre['id'];
				$nom = $unMembre['nom'];
				$prenom=$unMembre['prenom'];
				$login = $unMembre['login'];
				$mdp   = $unMembre['mdp'];
				$tel   = $unMembre['tel'];
				$mail   = $unMembre['mail'];
				$poste = $unMembre['poste'];
				?>	
				<tr>
					<td><?php echo $id ?></td>
					<td><?php echo $nom ?></td>
					<td><?php echo $prenom ?></td>
					<td><center><?php echo $login ?></center></td>
					<td><center><?php echo $mdp ?></center></td> 
					<td><center><?php echo $tel ?></center></td> 
					<td><center><?php echo $mail ?></center></td> 
					<td><center><?php echo $poste ?></center></td> 			
					<td><center><a href="index.php?uc=<?php echo $uc ?>&action=modifierMembre&id=<?php echo $id ?>"> 
			<img src="images/modifier.gif" TITLE="Modifier"> </a></center></td>
				</tr>				
		<?php			
			}
		?>
		</table>
           </div>		
<ul>       
 <a href="index.php?uc=<?php echo $uc ?>&action=ajouterMembre"><h5><u>ajouter un membre</u><h5></a>
</ul>
</fieldset>		  
