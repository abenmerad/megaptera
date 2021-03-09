<form method="post"  action="index.php?uc=gestion&action=confirmerAjouterMembre">
    <fieldset class="row">
        <legend>Ajout d'un membre</legend>
        <div class="form-group col col-md-6 mb-3">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" pattern="[a-zA-Z-]{2,}" required>
        </div>
        <div class="form-group col col-md-6 mb-3">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" pattern="[a-zA-Z]{2,}" required>
        </div>
        <div class="form-group col col-md-6 mb-3">
            <label for="login">Login</label>
            <input type="text" name="login" id="login" class="form-control" pattern="[a-zA-Z0-9]{4,10}" required>
        </div>
        <div class="form-group col col-md-6 mb-3">
            <label for="tel">Téléphone</label>
            <input type="text" name="tel" id="tel" class="form-control" pattern="[0-9]{10}" required>
        </div>
        <div class="form-group col col-md-6 mb-3">
            <label for="mail">Courriel</label>
            <input type="text" name="mail" id="mail" class="form-control" pattern="[a-zA-Z_\-.]*@[a-zA-Z]*.[a-zA-Z]*" required>
        </div>
        <div class="form-group col col-md-6 mb-3">
            <label for="poste">Poste</label>
            <select class="form-control" name="poste" id="poste">
                <?php if($_SESSION['poste'] == "superAdmin"): ?>
                    <?php foreach($lesPostes as $unPoste): ?>
                        <option value="<?= $unPoste['nom'] ?>"><?= $unPoste['nom'] ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach($lesPostes as $unPoste): ?>
                        <?php if($unPoste['nom'] == "Membre"): ?>
                            <option value="<?= $unPoste['nom'] ?>"><?= $unPoste['nom'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
        </div>
    </fieldset>
 </form>
