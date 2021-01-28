<form enctype="multipart/form-data" method="post" id="form_mesObservations" action="index.php?uc=<?= $_SESSION['poste']?>&action=mesObservations">
    <fieldset form="form_mesObservations" class="container">
        <legend>Rechercher vos observations</legend>
        <div class="row form-group">
            <div class="col-md-6 col-sm-12">
                <label for="anneeObs">Année</label>
                <select name="anneeObs" id="select_annee" class="form-control form-control-sm">
                    <option value="">Indifférent</option>
                    <?php for($i = 2010; $i <= date("Y", time()); $i++):?>
                        <option value="<?= $i ?>" <?= $select = (!empty($donnees) && $donnees['anneeObs'] == $i) ? "selected=\"selected\"" : ""?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col col-md-6 col-sm-12">
                <label for="etatObs">Etat</label>
                <select name="etatObs" id="select_etat" class="form-control form-control-sm">
                    <option value="">Indifférent</option>
                    <?php foreach($lesEtatsObservations as $unEtatObservation):?>
                        <option value="<?= $unEtatObservation['etat'] ?>" <?= $select = (!empty($donnees) && $donnees['etatObs'] == $unEtatObservation['etat']) ? "selected=\"selected\"" : ""?>><?= $unEtatObservation['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col col-md-6 col-sm-12">
                <label for="groupeObs">Groupe</label>
                <select name="groupeObs" id="select_groupe" class="form-control form-control-sm">
                    <option value="">Indifférent</option>
                    <?php foreach($lesGroupes as $unGroupe):?>
                        <option value="<?= $unGroupe['code'] ?>" <?= $select = (!empty($donnees) && $donnees['groupeObs'] == $unGroupe['code']) ? "selected=\"selected\"" : ""?>><?= $unGroupe['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col col-md-6 col-sm-12">
                <label for="lieuObs">Lieu</label>
                <select name="lieuObs" id="select_lieu" class="form-control form-control-sm">
                    <option value="">Indifférent</option>
                    <?php foreach($lesLieux as $unLieu):?>
                        <option value="<?= $unLieu['code'] ?>" <?= $select = (!empty($donnees) && $donnees['lieuObs'] == $unLieu['code']) ? "selected=\"selected\"" : ""?>><?= $unLieu['lieu'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
<!--        <div class="row form-group">-->
<!--                <div class="text-center"><a href="#filtre" class="btn btn-info" data-toggle="collapse">Plus de filtre</a></div>-->
<!--                <div id="filtre" class="collapse">-->
<!--                    <div class="col col-md-4 col-sm-12">-->
<!--                        <label for="groupeObs">Groupe</label>-->
<!--                        <select name="groupeObs" id="select_groupe" class="form-control form-control-sm">-->
<!--                            <option value="">Indifférent</option>-->
<!--                            --><?php //foreach($lesGroupes as $unGroupe):?>
<!--                                <option value="--><?//= $unGroupe['code'] ?><!--">--><?//= $unGroupe['libelle'] ?><!--</option>-->
<!--                            --><?php //endforeach; ?>
<!--                        </select>-->
<!--                    </div>-->
<!--                    <div class="col col-md-4 col-sm-12">-->
<!--                        <label for="lieuObs">Lieu</label>-->
<!--                        <select name="lieuObs" id="select_lieu" class="form-control form-control-sm">-->
<!--                            <option value="">Indifférent</option>-->
<!--                            --><?php //foreach($lesLieux as $unLieu):?>
<!--                                <option value="--><?//= $unLieu['code'] ?><!--">--><?//= $unLieu['lieu'] ?><!--</option>-->
<!--                            --><?php //endforeach; ?>
<!--                        </select>-->
<!--                    </div>-->
<!--                </div>-->
<!--        </div>-->
        <div class="justify-content-md-around justify-content-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
<!--            <input class="btn btn-outline-danger" type="reset" value="Reset">-->
        </div>
    </fieldset>
</form>