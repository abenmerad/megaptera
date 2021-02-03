<form enctype="multipart/form-data" method="post" id="form_observation" action="index.php?uc=<?= $_SESSION['poste']?>&action=confirmerModifierObservation&code=<?= $code ?>">
    <fieldset id="form1" form="form_observation" class="container">
        <legend>Mise à jour de l'observation</legend>
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
                </select>
            </div>
        </div>
        <div class="row justify-content-around form-group" id="selectOrientation">
            <div class="row col col-md-6 col-sm-12 text-left text-sm-center">
                <div class="col col-md-6 col-6">
                    <label class="textB" for="latOrientation">Nord
                        <input type="radio" name="latOrientation" id="lat_dirN" value="N" <?=(isset($_SESSION['data']['latOrientation']) && $_SESSION['data']['latOrientation'] == 'N') ? 'checked' : '' ?> <?=(isset($_SESSION['data']['latOrientation']) && $_SESSION['data']['latOrientation'] == 'N') ? '' : 'disabled' ?>>
                    </label>
                </div>
                <div class="col col-md-6 col-6">
                    <label class="textB" for="latOrientation">Sud
                        <input type="radio" name="latOrientation" id="lat_dirS" value="S" <?=(isset($_SESSION['data']['latOrientation']) && $_SESSION['data']['latOrientation'] == 'S') ? 'checked' : '' ?> <?=(isset($_SESSION['data']['latOrientation']) && $_SESSION['data']['latOrientation'] == 'S') ? '' : 'disabled' ?>>
                    </label>
                </div>
            </div>
            <div class="row col col-md-6 col-sm-12 text-left text-sm-center">
                <div class="col col-md-6 col-6">
                    <label class="textB" for="longOrientation">Est
                        <input type="radio" name="longOrientation" id="long_dirE" value="E" <?=(isset($_SESSION['data']['longOrientation']) && $_SESSION['data']['longOrientation'] == 'E') ? 'checked' : '' ?> <?=(isset($_SESSION['data']['longOrientation']) && $_SESSION['data']['longOrientation'] == 'E') ? '' : 'disabled' ?>>
                    </label>
                </div>
                <div class="col col-md-6 col-6">
                    <label class="textB" for="longOrientation">Ouest
                        <input type="radio" name="longOrientation" id="long_dirO" value="O" <?=(isset($_SESSION['data']['longOrientation']) && $_SESSION['data']['longOrientation'] == 'O') ? 'checked' : '' ?> <?=(isset($_SESSION['data']['longOrientation']) && $_SESSION['data']['longOrientation'] == 'N') ? '' : 'disabled' ?>>
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
                <div class="col-md-4 col-sm-6">
                    <label>Deg Long.
                        <input name="DegresLong" type="number" value="<?=(isset($_SESSION['data']['DegresLong'])) ? $_SESSION['data']['DegresLong'] : "0" ?>" min ="0" max = "99">
                    </label>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label>Min Long.
                        <input name="MinutesLong" type="number" value="<?=(isset($_SESSION['data']['MinutesLong'])) ? $_SESSION['data']['MinutesLong'] : "0" ?>" min ="0" max = "99">
                    </label>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label>Sec Long.
                        <input name="SecondesLong" type="number" value="<?=(isset($_SESSION['data']['SecondesLong'])) ? $_SESSION['data']['SecondesLong'] : "0" ?>" min ="0" max = "999">
                    </label>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
        <input class="btn btn-primary" type="submit" value="Valider">
    </div>
</form>