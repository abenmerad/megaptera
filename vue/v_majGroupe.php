<form method="post" class="container" action="index.php?uc=gestion&action=confirmerModifierGroupe&code=<?= $code ?>">
   <fieldset class="row">
       <legend>Modification d'un groupe</legend>
       <div class="form-group col-md-6 col-sm-12 mb-3 text-md-center offset-md-3">
           <label for="libelle">Libelle</label>
           <input type="text" name="libelle" id="libelle" class="form-control" placeholder="<?= $unGroupe['libelle'] ?>" pattern="[a-zA-Z\séèàê]{1,}">
       </div>
       <div class="form-group col col-md-6 col-sm-6 mb-3">
           <label for="operateur">Opérateur</label>
           <select class="form-control" name="operateur" id="selectOperateur">
               <option value="<" <?= ($unGroupe['operateur'] == "<") ? "selected" : "" ?>> < (Inférieur à la valeur)</option>
               <option value=">" <?= ($unGroupe['operateur'] == ">") ? "selected" : "" ?>> > (Supérieur à la valeur)</option>
               <option value="=" <?= ($unGroupe['operateur'] == "=") ? "selected" : "" ?>> = (Égale à la valeur)</option>
               <option value="%" <?= ($unGroupe['operateur'] == "%") ? "selected" : "" ?>> % (Multiple de la valeur)</option>
           </select>
       </div>
       <div class="form-group col col-md-6 col-sm-6 mb-3">
           <label for="valeur">Valeur</label>
           <select class="form-control" name="valeur">
                <?php for($i = 1; $i <= 35; $i++): ?>
                    <option value="<?= $i ?>" <?= ($unGroupe['valeur'] == $i) ? "selected" : "" ?>><?= $i ?></option>
                <?php endfor; ?>
           </select>
       </div>
       <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
           <input class="btn btn-primary" type="submit" value="Valider">
       </div>
	</fieldset>
</form>
