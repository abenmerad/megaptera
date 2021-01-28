<fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Liste suppression des membres</legend>
		<div class="row form-group" >
		<table  align = "center" border = "2" cellpadding="5">
		
				<tr>
						<th>CODE  </th>
						<th>NOM  </th>
						<th>PRENOM</th>
						<th>LOGIN</th> 
						<th>MDP</th>
						<th>POSTE</th>
					    <th>SUPPRESSION</th>
				</tr>
		<?php
			foreach( $lesMembres as $unMembre) 
			{
				$id = $unMembre['id'];
				$nom = $unMembre['nom'];
				$prenom=$unMembre['prenom'];
				$login = $unMembre['login'];
				$mdp   = $unMembre['mdp'];
				$poste = $unMembre['poste'];
			
				?>
									
				
					<tr>
					<td><?php echo $id ?></td>
					<td><?php echo $nom ?></td>
					<td><?php echo $prenom ?></td>
					<td><center><?php echo $login ?></center></td>
					<td><center><?php echo $mdp ?></center></td> 
					<td><center><?php echo $poste ?></center></td>
                    <?php
                    if($_SESSION['poste'] == "supAdmin")
                    {
                    ?>
                        <td><center><a href="index.php?uc=menuSuper&id=<?php echo $id ?>&action=confirmerSupprimerMembre"
					onclick="return confirm('Voulez-vous vraiment supprimer ce membre ?');">
					<img src="images/supprimer.gif" TITLE="Supprimer"> </center></a></td>
                    <?php
                    }
                    else
                    {?>
                        <td><center><a href="index.php?uc=menuAdmin&id=<?php echo $id ?>&action=confirmerSupprimerMembre"
                                       onclick="return confirm('Voulez-vous vraiment supprimer ce membre ?');">
                                    <img src="images/supprimer.gif" TITLE="Supprimer"> </center></a></td>
                    <?php
                    }
                    ?>

					
					</tr>
		
		<?php			
			}
		?>
		</table>
</div>	
</fieldset>	
