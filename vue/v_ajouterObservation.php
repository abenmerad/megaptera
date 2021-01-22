<form enctype="multipart/form-data" method="post" id="form_observation" action="index.php?uc=<?= $_SESSION['poste']?>&action=confirmer">
    <fieldset id="form1" form="form_observation" class="container">
        <legend>Observation</legend>
        <div class="row form-group" id="ajoutImg">
            <div class="col-md-6 col-sm-12"> 
                <label  for="nomImg">Transfère le fichier</label>
                <input type="file" class="form-control-file" name="nomImg" accept="image/*" size="1024" files>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6 col-sm-12" id="selectLieu">
                <label for="Lieu">Lieu</label>
                <select name="Lieu" class="form-control form-control-sm">
                    <option value="NULL">Veuillez selectionner un lieu</option>
                    <?php foreach($lesLieux as $unLieu): ?>
                        <?php if ($unLieu['code'] !="AUT"): ?>
                            <option value="<?= $unLieu['code'] ?>" <?= $select = (!empty($donnees) && $donnees['Lieu'] == $unLieu['code']) ? "selected=\"selected\"" : ""?>><?= $unLieu['lieu'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <option value="Autre" id="autre">Autre</option>
                </select>
            </div>
            <div class="col-md-6 col-sm-12" id="infoLieu">
                <textarea class="form-control" id="lieuAutre" type="text"  name="LieuAutre" size="250" maxlength="100" placeholder="Si le lieu est autre, merci d'entrez les informations nécessaire : 100 caractères maximum"><?= $select = (!empty($donnees)) ? $donnees['LieuAutre'] : "" ?></textarea>
            </div>
        </div>
<!--        <div class="d-flex justify-content-around form-group" id="selectOrientation">-->
<!--            <div class="p-3">-->
<!--                <label class="textB" for="latOrientation">Nord-->
<!--                    <input type="radio" name="latOrientation" id="lat_dirN" value="N">-->
<!--                </label>-->
<!--            </div>-->
<!--            <div class="p-3">-->
<!--                <label class="textB" for="latOrientation">Sud-->
<!--                    <input type="radio" name="latOrientation" id="lat_dirS" value="S"> -->
<!--                </label>-->
<!--            </div>-->
<!--            <div class="p-3">-->
<!--                <label class="textB" for="longOrientation">Est-->
<!--                    <input type="radio" name="longOrientation" id="long_dirE" value="E">-->
<!--                </label>-->
<!--            </div>-->
<!--            <div class="p-3">-->
<!--                <label class="textB" for="longOrientation">Ouest-->
<!--                    <input type="radio" name="longOrientation" id="long_dirO" value="O">    -->
<!--                </label>-->
<!--            </div>-->
<!--        </div>-->
        <div class="d-flex justify-content-md-around form-group" id="selectCoordonnees">
            <div id="coordonneesLat" class="row">
                <div class="col-md-4 col-sm-6">
                    <label>Deg Lat.
                        <input name="DegresLat" type="number" value="<?= $select = (!empty($donnees)) ? $donnees['DegresLat'] : "0" ?>" min ="0" max = "99">
                    </label>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label>Min Lat.<br>
                        <input name="MinutesLat" type="number" value="<?= $select = (!empty($donnees)) ? $donnees['MinutesLat'] : "0" ?>"  min ="0" max = "59">
                    </label>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label>Sec Lat.<br>
                        <input name="SecondesLat" type="number" value="<?= $select = (!empty($donnees)) ? $donnees['SecondesLat'] : "0" ?>" min ="0" max = "999">
                    </label>
                </div>
            </div>
            <div id="coordonneesLong" class="row">
                <div class="col-md-4 col-sm-6">
                    <label>Deg Long.
                        <input name="DegresLong" type="number" value="<?= $select = (!empty($donnees)) ? $donnees['DegresLong'] : "0" ?>" min ="0" max = "99">
                    </label>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label>Min Long.
                        <input name="MinutesLong" type="number" value="<?= $select = (!empty($donnees)) ? $donnees['MinutesLong'] : "0" ?>" min ="0" max = "99">
                    </label>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label>Sec Long.
                        <input name="SecondesLong" type="number" value="<?= $select = (!empty($donnees)) ? $donnees['SecondesLong'] : "0" ?>" min ="0" max = "999">
                    </label>
                </div>
            </div>
        </div>
        <div class="row form-group" id="selectTime">
            <div class="col-md-4 col-sm-12">
                <label for="HeureDebut">heure de debut d'observation</label>
                <input type="time" id="heureDebut" name="HeureDebut" value="<?= $select = (!empty($donnees)) ? $donnees['HeureDebut'] : "" ?>">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="HeureFin" >heure de fin d'observation</label>
                <input type="time" id="heureFin" name="HeureFin" value="<?= $select = (!empty($donnees)) ? $donnees['HeureFin'] : "" ?>">
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="DateObservation">Date Observation</label>
                <input type="date" id="dateObservation" name="DateObservation" value="<?= $select = (!empty($donnees)) ? $donnees['DateObservation'] : "" ?>">
            </div>
        </div>
    </fieldset>
    <fieldset form="form_observation" class="container form-group" id="observationEspece">
        <legend>Caracteristiques</legend>
        <div class="row form-group">
            <div class="col-md-6">
                <div>
                    <label for = "Dominante">Dominante</label><div class="erreur" hidden>Veuillez remplir le champ ci-dessous.</div>
                    <select class="form-control form-control-sm" name="Dominante" id="selectDominante">
                        <option value="NULL">Veuillez selectionner la dominante</option>
                        <?php foreach($lesDominantes as $uneDominante): ?>
                            <option value="<?= $uneDominante['id'] ?>" <?= $select = (!empty($donnees) && $donnees['Dominante'] == $uneDominante['id']) ? "selected=\"selected\"" : ""?>><?= $uneDominante['libelle'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for = "Papillon">Papillon</label>
                    <select class="form-control form-control-sm"  name="Papillon" id="#selectPapillon">
                        <option value="NULL">Veuillez selectionner le papillon</option>
                        <option value="Oui" <?= $select = (!empty($donnees) && $donnees['Papillon'] == "Oui") ? "selected=\"selected\"" : ""?>>Oui</option>
                        <option value="Non" <?= $select = (!empty($donnees) && $donnees['Papillon'] == "Non") ? "selected=\"selected\"" : ""?>>Non</option>
                    </select>
                </div>

                <div>
                    <label for = "Caudale">Type de Caudale</label>
                    <SELECT class="form-control form-control-sm"  name="Caudale" id="selectCaudale">
                        <option value="NULL">Veuillez selectionner le Type de Caudale</option>
                        <?php for ($i=1; $i < 6 ; $i++) { ?>
                            <option id = "<?= "typeCaudale" . $i ?>" <?= $select = (!empty($donnees) && intval($donnees['Caudale']) == $i) ? "selected=\"selected\"" : ""?>> <?= $i ?> </option>
                        <?php } ?>
                    </SELECT>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div>
                    <label for = "Groupe">Type de Groupe</label>
                    <SELECT class="form-control form-control-sm"  name="Groupe" id ="lstGrp">
                        <option value="NULL">Veuillez selectionner le groupe</option>
                        <?php foreach($lesGroupes as $unGroupe){ ?>
                            <option value="<?php echo $unGroupe['code'];?>" <?= $select = (!empty($donnees) && $donnees['Groupe'] == $unGroupe['code']) ? "selected=\"selected\"" : ""?>><?php echo $unGroupe['libelle'];?></option>
                        <?php } ?>
                    </SELECT>
                </div>

                <div>
                    <label for = "NombreIndividu">Nombre d'individus</label>
                    <SELECT class="form-control form-control-sm"  name="NombreIndividu" id ="lstNbrIndividu">
                        <option value="NULL">Veuillez selectionner le nombre d'individus</option>
                        <?php for($i = 1; $i <= 15; $i++): ?>
                        <option value="<?=$i?>" <?= $select = (!empty($donnees) && intval($donnees['NombreIndividu']) == $i) ? "selected=\"selected\"" : ""?>><?=$i?></option>
                        <?php endfor; ?>
                    </SELECT>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6 col-sm-12">
                <label for="Description">Commentaire</label>
                <textarea name="Description" class="form-control form-control-sm" id="description" placeholder="500 caractères maximum"><?= $select = (!empty($donnees)) ? $donnees['Description'] : ""?></textarea>
            </div>

            <div class="col-md-6">
                <label for="Comportement">Comportement</label>
                <textarea name="Comportement" class="form-control form-control-sm" id="comportement" placeholder="500 caractères maximum"><?= $select = (!empty($donnees)) ? $donnees['Comportement'] : ""?></textarea>
            </div>
        </div>
      
		<div class="d-flex flex-md-row flex-sm-row flex-column justify-content-md-center justify-content-sm-center" id="Button">
          <!--  <button type="button" class="btn btn-outline-primary col-md-4 col-sm-6 col-12" id="submitForm">Valider</button>-->
			<input class="btn btn-primary" type="submit" value="Valider" name="valider">
	    </div>
    </fieldset>
 </form>
 