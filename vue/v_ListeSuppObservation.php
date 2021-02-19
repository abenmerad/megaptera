 <?php
 $uc=$_SESSION['poste'];
 
 ?>
 <fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Liste des observations non validées à supprimer</legend>
		<div class="row form-group" >
  
		<table  align = "center"  border = "2" cellpadding="15">
				<tr>
						<th >PHOTO </th>
						<th>OBSERVATION</th>
					    <Th>CARACTERISTIQUE</th>
						<th>SUPP
				</tr>
		<?php
			foreach($lesObservations as $uneObservation)
			{
			    $nomPhoto = $uneObservation['nomPhoto'];
		        $code = $uneObservation['codeObservation'];
				$lieu = $uneObservation['libLieu'];
		    	$latitude=$uneObservation['orientationLat'];
				$longitude=$uneObservation['orientationLong'];
				if ($latitude =='S')
				{  $latitude = "SUD";
				}
				else
				{ 
					$latitude = "NORD";
			    }
				if ($longitude =='O')
				{  $longitute = "OUEST";
				}
				else
				{ 
					$longitude = "EST";
			    }
			
				$degLat=$uneObservation['latitude'];
				$degLong=$uneObservation['longitude'];
				
				$dateObservation = $uneObservation['dateObservation'];
				$heureDebut = $uneObservation['heureDebutObservation'];
				$heureFin = $uneObservation['heureFinObservation'];
				$dominante = $uneObservation['libDominante'];
				$caudale = $uneObservation['typeCaudale'];
				$groupe=$uneObservation['libGroupe'];
				$papillon=$uneObservation['papillon'];
				
				if ($uneObservation['lieuObservation'] == "AUT")
				{
				   $autreLieu = "Autre Lieu =".$uneObservation['autreLieu'];
				}
				else
				{   $autreLieu = " ";
			    }
				$nbInd=$uneObservation['nbIndividus'];
				$commentaire=$uneObservation['commentaire'];
				$comportement=$uneObservation['comportement'];
				
				$auteur=$uneObservation['nom'];
			
				?>	
				<tr>
				<div class="col-md-6 col-sm-12" >
					<td> <a href='images/<?php echo$nomPhoto?>' rel='shadowbox'><img src='images/<?php echo $nomPhoto?>' height=180 width=152 ><br>
						</a>
				  </td>
				  </div>
				  <div class="col-md-6 col-sm-12" >
					<td>
						Nom de l'observation = <?php echo $code ?>&nbsp&nbsp&nbsp&nbspAuteur = <?php echo $auteur?><br>
						Lieu : <?php echo $lieu ?> &nbsp&nbsp&nbsp&nbsp<?php echo $autreLieu ?><br>
						Latitude =<?php echo $latitude ?> &nbsp&nbsp&nbsp&nbsp<?php echo $degLat ?>&nbsp&nbsp&nbsp&nbspLongitude =<?php echo $longitude ?> &nbsp&nbsp&nbsp&nbsp<?php echo $degLong ?>&nbsp&nbsp&nbsp&nbsp<br>
					    Date Observation =<?php echo $dateObservation ?><br>
						Heure Debut =<?php echo $heureDebut ?> &nbsp&nbsp&nbsp&nbsp  Heure Fin =<?php echo $heureFin ?><br> 
					  
			       </td>
				   </div>
				     <div class="col-xs-3 col-md-6 col-sm-12" >
				   <td>
				    Dominante =<?php echo $dominante ?>&nbsp&nbsp&nbsp&nbsp  Groupe =<?php echo $groupe ?><br> 
					Papillon =<?php echo $papillon ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  nombre d'individus =<?php echo $nbInd ?><br>
					Caudale =<?php echo $caudale ?><br>
					commentaire =<?php echo $commentaire ?><br>
					comportement =<?php echo $comportement ?><br>
					</td>
					<td><center><a href="index.php?uc=<?php echo $uc ?>&code=<?php echo $code ?>&action=confirmerSupprimerObservation" 
					onclick="return confirm('Voulez-vous vraiment supprimer cette observation ?');"> 
					<img src="images/supprimer.gif" TITLE="Supprimer"> </center></a></td>
					</div>


				</tr>				
		<?php			
			}
		?>
		</table>	

</div>		
</fieldset> 
