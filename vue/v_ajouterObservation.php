<form enctype="multipart/form-data" method="post" id="form_observation" action="index.php?uc=observation&action=confirmer">
    <fieldset form="form_observation" class="container">
        <legend>Observation</legend>
        <div class="form-group" id="ajoutImg">
            <div class="row col-md-6 col-sm-12">
                <label  for="nomImg[]">Transfère le fichier (Format accepté : JPG/JPEG, PNG)</label>
                <input type="file" class="form-control-file" name="nomImg" accept="image/jpeg, image/png">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6 col-12" id="selectLieu">
                <label for="Lieu">Lieu</label>
                <select name="Lieu" class="form-control form-control-sm">
                    <option value="">Veuillez selectionner un lieu</option>
                    <?php foreach($lesLieux as $unLieu): ?>
                        <?php if ($unLieu['code'] !="AUT"): ?>
                            <option value="<?= $unLieu['code'] ?>" <?=$select = (isset($_SESSION['data']['Lieu']) && $_SESSION['data']['Lieu'] == $unLieu['code']) ? "selected=\"selected\"" : ""?>><?= $unLieu['lieu'] . ' (' . $unLieu['code'] . ')' ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <option value="AUT" id="autre">Autre</option>
                </select>
            </div>
            <div class="col-md-6 col-sm-12" id="infoLieu">
                <textarea class="form-control" id="lieuAutre" type="text"  name="LieuAutre" size="250" maxlength="100" placeholder="Si le lieu est autre, merci d'entrez les informations nécessaire : 100 caractères maximum"><?=(isset($_SESSION['data']['LieuAutre'])) ? $_SESSION['data']['LieuAutre'] : "" ?></textarea>
            </div>
        </div>
        <div class="row justify-content-around form-group" id="selectOrientation">
            <div class="row col col-md-6 col-sm-6">
                <div class="col col-md-6 col-sm-6">
                    <label class="textB" for="latOrientation">Nord
                        <input type="radio" name="latOrientation" id="lat_dirN" value="N" <?=(isset($_SESSION['data']['latOrientation']) && $_SESSION['data']['latOrientation'] == 'N') ? 'checked' : '' ?> <?=(isset($_SESSION['data']['latOrientation']) && $_SESSION['data']['latOrientation'] == 'N') ? '' : 'disabled' ?>>
                    </label>
                </div>
                <div class="col col-md-6 col-sm-6">
                    <label class="textB" for="latOrientation">Sud
                        <input type="radio" name="latOrientation" id="lat_dirS" value="S" <?=(isset($_SESSION['data']['latOrientation']) && $_SESSION['data']['latOrientation'] == 'S') ? 'checked' : '' ?> <?=(isset($_SESSION['data']['latOrientation']) && $_SESSION['data']['latOrientation'] == 'S') ? '' : 'disabled' ?>>
                    </label>
                </div>
            </div>
            <div class="row col col-md-6 col-sm-12">
                <div class="col col-md-6 col-sm-6">
                    <label class="textB" for="longOrientation">Est
                        <input type="radio" name="longOrientation" id="long_dirE" value="E" <?=(isset($_SESSION['data']['longOrientation']) && $_SESSION['data']['longOrientation'] == 'E') ? 'checked' : '' ?> <?=(isset($_SESSION['data']['longOrientation']) && $_SESSION['data']['longOrientation'] == 'E') ? '' : 'disabled' ?>>
                    </label>
                </div>
                <div class="col col-md-6 col-sm-6">
                    <label class="textB" for="longOrientation">Ouest
                        <input type="radio"  name="longOrientation" id="long_dirO" value="O" <?=(isset($_SESSION['data']['longOrientation']) && $_SESSION['data']['longOrientation'] == 'O') ? 'checked' : '' ?> <?=(isset($_SESSION['data']['longOrientation']) && $_SESSION['data']['longOrientation'] == 'O') ? '' : 'disabled' ?>>
                    </label>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-md-around form-group" id="selectCoordonnees">
            <div id="coordonneesLat" class="row">
                <div class="col-md-4 col-sm-6">
                    <label>Deg Lat.
                        <input name="DegresLat" type="number" value="<?=(isset($_SESSION['data']['DegresLat'])) ? $_SESSION['data']['DegresLat'] : "0" ?>" min ="0" max = "99">
                    </label>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label>Min Lat.<br>
                        <input name="MinutesLat" type="number" value="<?=(isset($_SESSION['data']['MinutesLat'])) ? $_SESSION['data']['MinutesLat'] : "0" ?>"  min ="0" max = "59">
                    </label>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label>Sec Lat.<br>
                        <input name="SecondesLat" type="number" value="<?=(isset($_SESSION['data']['SecondesLat'])) ? $_SESSION['data']['SecondesLat'] : "0" ?>" min ="0" max = "999">
                    </label>
                </div>
            </div>
            <div id="coordonneesLong" class="row">
                <div class="col-md-4 col-sm-6 mb-3">
                    <label>Deg Long.
                        <input name="DegresLong" type="number" value="<?=(isset($_SESSION['data']['DegresLong'])) ? $_SESSION['data']['DegresLong'] : "0" ?>" min ="0" max = "99">
                    </label>
                </div>
                <div class="col-md-4 col-sm-6 mb-3">
                    <label>Min Long.
                        <input name="MinutesLong" type="number" value="<?=(isset($_SESSION['data']['MinutesLong'])) ? $_SESSION['data']['MinutesLong'] : "0" ?>" min ="0" max = "99">
                    </label>
                </div>
                <div class="col-md-4 col-sm-6 mb-3">
                    <label>Sec Long.
                        <input name="SecondesLong" type="number" value="<?=(isset($_SESSION['data']['SecondesLong'])) ? $_SESSION['data']['SecondesLong'] : "0" ?>" min ="0" max = "999">
                    </label>
                </div>
            </div>
        </div>
        <div class="row form-group text-md-center" id="selectTime">
            <div class="col-md-4 col-sm-12 mb-3">
                <label for="HeureDebut">Heure de debut</label>
                <input type="time" id="heureDebut" name="HeureDebut" value="<?=(isset($_SESSION['data']['HeureDebut'])) ? $_SESSION['data']['HeureDebut'] : "" ?>">
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                <label for="HeureFin" >Heure de fin</label>
                <input type="time" id="heureFin" name="HeureFin" value="<?=(isset($_SESSION['data']['HeureFin'])) ? $_SESSION['data']['HeureFin'] : "" ?>">
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                <label for="DateObservation">Date Observation</label>
                <input type="date" id="dateObservation" name="DateObservation" value="<?=(isset($_SESSION['data']['DateObservation'])) ? $_SESSION['data']['DateObservation'] : "" ?>">
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
                        <option value="">Veuillez selectionner la dominante</option>
                        <?php foreach($lesDominantes as $uneDominante): ?>
                            <option value="<?= $uneDominante['id'] ?>" <?=(isset($_SESSION['data']['Dominante']) && $_SESSION['data']['Dominante'] == $uneDominante['id']) ? "selected=\"selected\"" : ""?>><?= $uneDominante['libelle'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for = "Papillon">Papillon</label>
                    <select class="form-control form-control-sm"  name="Papillon" id="#selectPapillon">
                        <option value="">Veuillez selectionner le papillon</option>
                        <option value="Oui" <?=(isset($_SESSION['data']['Papillon']) && $_SESSION['data']['Papillon'] == "Oui") ? "selected=\"selected\"" : ""?>>Oui</option>
                        <option value="Non" <?=(isset($_SESSION['data']['Papillon']) && $_SESSION['data']['Papillon'] == "Non") ? "selected=\"selected\"" : ""?>>Non</option>
                    </select>
                </div>

                <div>
                    <label for="Caudale">Type de Caudale</label>
                    <SELECT class="form-control form-control-sm"  name="Caudale" id="selectCaudale">
                        <option value="">Veuillez selectionner le Type de Caudale</option>
                        <?php for ($i=1; $i < 6 ; $i++) { ?>
                            <option id = "<?= "typeCaudale" . $i ?>" <?=(isset($_SESSION['data']['Caudale']) && intval($_SESSION['data']['Caudale']) == $i) ? "selected=\"selected\"" : ""?>> <?= $i ?> </option>
                        <?php } ?>
                    </SELECT>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div>
                    <label for="Groupe">Type de Groupe</label>
                    <SELECT class="form-control form-control-sm"  name="Groupe" id ="lstGrp">
                        <option value="">Veuillez selectionner le groupe</option>
                        <?php foreach($lesGroupes as $unGroupe): ?>
                            <option value="<?= $unGroupe['code'] ?>" <?=(isset($_SESSION['data']['Groupe']) && $_SESSION['data']['Groupe'] == $unGroupe['code']) ? "selected=\"selected\"" : ""?>><?php echo $unGroupe['libelle'];?></option>
                        <?php endforeach; ?>
                    </SELECT>
                </div>

                <div>
                    <label for="NombreIndividu">Nombre d'individus</label>
                    <SELECT class="form-control form-control-sm"  name="NombreIndividu" id ="lstNbrIndividu">
                        <option value="">Veuillez selectionner le nombre d'individus</option>
                        <?php for($i = 1; $i <= 25; $i++): ?>
                        <option value="<?= $i ?>" <?=(isset($_SESSION['data']['NombreIndividu']) && intval($_SESSION['data']['NombreIndividu']) == $i) ? "selected=\"selected\"" : ""?>><?=$i?></option>
                        <?php endfor; ?>
                    </SELECT>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6 col-sm-12">
                <label for="Description">Commentaire</label>
                <textarea name="Description" class="form-control form-control-sm" id="description" placeholder="500 caractères maximum"><?=(isset($_SESSION['data']['Description'])) ? $_SESSION['data']['Description'] : ""?></textarea>
            </div>

            <div class="col-md-6">
                <label for="Comportement">Comportement</label>
                <textarea name="Comportement" class="form-control form-control-sm" id="comportement" placeholder="500 caractères maximum"><?=(isset($_SESSION['data']['Comportement'])) ? $_SESSION['data']['Comportement'] : ""?></textarea>
            </div>
        </div>
		<div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
			<input class="btn btn-primary" type="submit" value="Valider">
	    </div>
    </fieldset>
 </form>