<form method="post" class="container" id="form_modifMembre" action="index.php?uc=<?= $_SESSION['poste'] ?>&action=confirmerModifierMembre&id=<?= $unMembre['id'] ?>">
   <fieldset form="form_modifMembre" class="row">
        <legend>Modification d'un membre</legend>
        <div class="form-group col col-md-6 mb-3">
                <label for="nom">Nom : </label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="<?= $unMembre['nom'] ?>">
        </div>
       <div class="form-group col col-md-6 mb-3">
           <label for="prenom">Prénom : </label>
           <input type="text" name="prenom" id="prenom" class="form-control" placeholder="<?= $unMembre['prenom'] ?>">
       </div>
       <div class="form-group col col-md-6 mb-3">
           <label for="login">Login : </label>
           <input type="text" name="login" id="login" class="form-control" placeholder="<?= $unMembre['login'] ?>">
       </div>
       <div class="form-group col col-md-6 mb-3">
           <label for="tel">Téléphone : </label>
           <input type="text" name="tel" id="tel" class="form-control" placeholder="<?= $unMembre['tel'] ?>" pattern="[0-9]{10}">
       </div>
       <div class="form-group col col-md-6 mb-3">
           <label for="mail">Courriel : </label>
           <input type="text" name="mail" id="mail" class="form-control" placeholder="<?= $unMembre['mail'] ?>" pattern="[a-zA-Z_-.]*@[a-zA-Z]*.[a-zA-Z]*">
       </div>
       <div class="form-group col col-md-6 mb-3">
           <label for="poste">Poste</label>
           <select class="form-control" name="poste" id="poste">
               <?php foreach($lesPostes as $unPoste): ?>
                    <option value="<?= $unPoste['poste'] ?>"><?= $unPoste['poste'] ?></option>
               <?php endforeach; ?>
           </select>
       </div>
       <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
           <input class="btn btn-primary" type="submit" value="Valider">
       </div>
   </fieldset>
</form>
