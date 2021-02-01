 <?php
 $uc=$_SESSION['poste'];
 ?>

 <fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Liste des observations a valider</legend>
		<div class="row form-group" >
  
		<table  align = "center"  border = "2" cellpadding="15">
				<tr>
						<th >PHOTO </th>
						<th>OBSERVATION</th>
					    
						<th>VALIDER</th>
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
				
				$dateObservation = explode('-', $uneObservation['dateObservation']);
				$heureDebut = $uneObservation['heureDebutObservation'];
				$heureFin = $uneObservation['heureFinObservation'];
				
				if ($uneObservation['lieuObservation'] == "AUT")
				{
				   $autreLieu = "Autre Lieu =".$uneObservation['autreLieu'];
				}
				else
				{   $autreLieu = " ";
			    }
				
				
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
						Nom de l'observation = <?php echo $code ?><br>
						Auteur = <?php echo $auteur?><br>
						Date Enregistrement = <br>
						Lieu : <?php echo $lieu ?> &nbsp&nbsp&nbsp&nbsp<?php echo $autreLieu ?><br>
						Latitude =<?php echo $latitude ?> &nbsp&nbsp&nbsp&nbsp<?php echo $degLat ?>&nbsp&nbsp&nbsp&nbspLongitude =<?php echo $longitude ?> &nbsp&nbsp&nbsp&nbsp<?php echo $degLong ?>&nbsp&nbsp&nbsp&nbsp<br>
					    Date Observation =<?php echo $dateObservation[2] ?>-<?php echo $dateObservation[1] ?>-<?php echo $dateObservation[0] ?><br>
						Heure Debut =<?php echo $heureDebut ?> &nbsp&nbsp&nbsp&nbsp  Heure Fin =<?php echo $heureFin ?><br> 
					  
			       </td>
		    <?php
                if($uneObservation['lieuObservation'] == 'AUT')
                {
            ?>
                    <td><center><a href="index.php?uc=<?php echo $uc ?>&action=confirmerValiderUneObservation&code=<?php echo $code ?>">
                                <img src="images/modifier.gif" TITLE="Modifier"> </a></center></td>
            <?php
                }
                else
                {?>
                    <td><center><a href="index.php?uc=<?php echo $uc ?>&action=confirmerValiderUneObservation&code=<?php echo $code ?>">
                                <img src="images/modifier.gif" TITLE="Modifier"> </a></center></td>

                    <td><center><a href="index.php?uc=<?php echo $uc ?>&action=confirmerValiderUneObservation&code=<?php echo $code ?>">
                                <img src="images/modifier.gif" TITLE="Valider"> </a></center></td>
                    <?php
                }
            ?>

				</tr>		
					</div>
				</tr>				
		<?php			
			}
		?>
		</table>	

</div>		
</fieldset> 
