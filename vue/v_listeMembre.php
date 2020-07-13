<div id="Lieu">
<?php
	if($_SESSION['poste'] == 'menuSuper')
	 {
		 $uc = 'menuSuper';
	 }
	 if($_SESSION['poste'] == 'admin')
	 {
		 $uc = 'menuAdmin';
	 }
	 echo "valeur liste $uc";
 ?>
     <h1> Liste des membres</h1>
		<table >
				<tr>
						<th>CODE  </th>
						<th>NOM  </th>
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
<ul>       
<li><a href="index.php?uc=<?php echo $uc ?>&action=ajouterMembre">ajouter un membre</a></li>
</ul>
</div		  
