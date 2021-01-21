<?php
 $uc=$_SESSION['poste'];
 ?>
<form enctype="multipart/form-data" method="post" id="form_observation" action="index.php?uc=<?php echo $uc ?>&action=rechercher">
    <fieldset id="form1" form="form_observation" class="container">
        <legend>Recherche observations</legend>
       <div class="row form-group"> 
            <div class="col-md-6 " >
			    <div>
					<label for="Lieu">Lieu</label>
						<select name="Lieu" class="form-control form-control-sm">
							<option value="NULL">Veuillez selectionner un lieu</option>

							<?php foreach($lesLieux as $unLieu){ 
							if($unLieu['code'] == $lieuxASelectionner){
							?>
							<option selected value="<?php echo $unLieu['code'] ?>"><?php echo  $unLieu['lieu']; ?> </option>
							<?php 
							}
							else{ ?>
							<option value="<?php echo $unLieu['code'];?>"><?php echo $unLieu['lieu'];?></option>
							<?php } 
							} ?>
						</select>
				</div>
				<div>
				
					<label for = "annee">Année</label>
					<select name="Annee" class="form-control form-control-sm">>
						<option value="NULL">Veuillez selectionner une année</option>
						<?php foreach($lesAnnees as $uneAnnee){
							if($uneAnnee['annee'] == $anneeASelectionner){
						    ?>
							<option selected value="<?php echo $uneAnnee['annee'] ?>"><?php echo  $uneAnnee['annee']; ?> </option>
							<?php 
							}
							else{ ?>
						
							<option value="<?php echo $uneAnnee['annee'];?>"><?php echo $uneAnnee['annee'];?></option>
						<?php } 
						} ?>
					</select>
				</div>
			</div>
            <div class="col-md-6 col-sm-12">
                <div>
                    <label for = "Dominante">Dominante</label>
                    <select class="form-control form-control-sm" name="Dominante" id="selectDominante">
                        <option value="NULL">Veuillez selectionner une dominante</option>

						<?php foreach($lesDominantes as $uneDominante){ 
						if($uneDominante['id'] == $dominanteASelectionner){
						    ?>
							<option selected value="<?php echo $uneDominante['id'] ?>"><?php echo  $uneDominante['libelle'] ;?> </option>
							<?php 
							}
							else{ ?>
						
                            <option value="<?php echo $uneDominante['id'];?>"><?php echo $uneDominante['libelle'];?></option>
                        <?php } 
						} ?>
                    </select>
                </div>
             
   
                <div>
                    <label for = "Groupe">Type de Groupe</label>
                    <SELECT class="form-control form-control-sm"  name="Groupe" id ="selectGroupe">
                          <option value="NULL">Veuillez selectionner un groupe</option>
					   <?php foreach($lesGroupes as $unGroupe){
								if($unGroupe['code'] == $groupeASelectionner){
						    ?>
							<option selected value="<?php echo $unGroupe['code'] ?>"><?php echo  $unGroupe['libelle']; ?> </option>
							<?php 
							}
							else{ ?>
						   <option value="<?php echo $unGroupe['code'];?>"><?php echo $unGroupe['libelle'];?></option>
							<?php } 
						} ?>
                    </SELECT>
                </div>
		    </div>
	        </div>
	
				<div class="d-flex flex-md-row flex-sm-row flex-column justify-content-md-center justify-content-sm-center" id="Button">
          <!--  <button type="button" class="btn btn-outline-primary col-md-4 col-sm-6 col-12" id="submitForm">Valider</button>-->
			<input  class="btn btn-primary" type = "submit" value = "Valider" name = "valider">
	    </div>
	 </fieldset>
</form>
<form action="">
    <div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</form>