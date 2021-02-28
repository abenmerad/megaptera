<form method="post" class="container" action="index.php?uc=menuSuper&action=confirmerAjouterGroupe">
    <fieldset class="row">
        <legend>Ajouter un groupe</legend>
        <div class="form-group col-md-6 col-sm-12 mb-3 text-md-center offset-md-3">
            <label for="libelle">Libelle</label>
            <input type="text" name="libelle" id="libelle" class="form-control" pattern="[a-zA-Z\séèàê]{1,}" required>
        </div>
        <div class="form-group col col-md-6 col-sm-6 mb-3">
            <label for="operateur">Opérateur</label>
            <select class="form-control" name="operateur" id="selectOperateur" required>
                <option value=""> Choisissez un opérateur</option>
                <option value="<"> < (Inférieur à la valeur)</option>
                <option value=">"> > (Supérieur à la valeur)</option>
                <option value="="> = (Égale à la valeur)</option>
                <option value="%"> % (Multiple de la valeur)</option>
            </select>
        </div>
        <div class="form-group col col-md-6 col-sm-6 mb-3">
            <label for="valeur">Valeur</label>
            <select class="form-control" name="valeur" required>
                <option value="">Choisissez une valeur</option>
                <?php for($i = 1; $i <= 35; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
        </div>
    </fieldset>
</form>
