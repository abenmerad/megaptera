<form enctype="multipart/form-data" method="post" id="form_rechercheObservations" action="index.php?uc=observation&action=lesObservations">
    <fieldset form="form_rechercheObservations" class="container">
        <legend>Rechercher des observations</legend>
        <div class="row form-group">
            <div class="col-md-4 col-sm-12">
                <label for="anneeObs">Année</label>
                <select name="anneeObs" id="select_annee" class="form-control form-control-sm">
                    <option value="">Indifférent</option>
                    <?php for($i = 2010; $i <= date("Y", time()); $i++):?>
                        <option value="<?= $i ?>" <?= (!empty($donnees) && $donnees['anneeObs'] == $i) ? "selected=\"selected\"" : ""?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col col-md-4 col-sm-12">
                <label for="groupeObs">Groupe</label>
                <select name="groupeObs" id="select_groupe" class="form-control form-control-sm">
                    <option value="">Indifférent</option>
                    <?php foreach($lesGroupes as $unGroupe):?>
                        <option value="<?= $unGroupe['code'] ?>" <?= (!empty($donnees) && $donnees['groupeObs'] == $unGroupe['code']) ? "selected=\"selected\"" : ""?>><?= $unGroupe['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col col-md-4 col-sm-12">
                <label for="lieuObs">Lieu</label>
                <select name="lieuObs" id="select_lieu" class="form-control form-control-sm">
                    <option value="">Indifférent</option>
                    <?php foreach($lesLieux as $unLieu):?>
                        <option value="<?= $unLieu['code'] ?>" <?= (!empty($donnees) && $donnees['lieuObs'] == $unLieu['code']) ? "selected=\"selected\"" : ""?>><?= $unLieu['lieu'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
                <div class="text-center">
                    <a href="#filtre" data-toggle="collapse" id="plus_filtre" class="btn btn-light" style="border-radius: 30px;">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
                <div id="filtre" class="collapse row">
                    <div class="col col-md-8 col-sm-12">
                        <label for="couleurObs">Couleur dominante</label>
                        <select name="couleurObs" id="select_couleur" class="form-control form-control-sm">
                            <option value="">Indifférent</option>

                            <?php foreach($lesDominantes as $uneDominante): ?>
                                <option value="<?= $uneDominante['id'] ?>"><?= $uneDominante['libelle'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col col-md-8 col-sm-12">
                        <label for="caudaleObs">Type caudale</label>
                        <select name="caudaleObs" id="select_caudale" class="form-control form-control-sm">
                            <option value="">Indifférent</option>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col col-md-8 col-sm-12">
                        <label for="papillonObs">Papillon</label>
                        <select name="papillonObs" id="select_papillon" class="form-control form-control-sm">
                            <option value="">Indifférent</option>
                            <option value="Oui">Oui</option>
                            <option value="Non">Non</option>
                        </select>
                    </div>
                    <div class="col col-md-8 col-sm-12">
                        <label for="papillonObs">Nombre d'individus</label>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="minIndividus">Entre
                                    <select name="minIndividus" class="form-control form-control-sm">
                                        <option value="">Indifferent</option>
                                        <?php for($i = 0; $i <= 25; $i++): ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </label>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="maxIndividus">Et
                                    <select name="maxIndividus" class="form-control form-control-sm">
                                        <option value="">Indifferent</option>
                                        <?php for($i = 0; $i <= 25; $i++): ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="justify-content-md-around justify-content-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
        </div>
    </fieldset>
</form>