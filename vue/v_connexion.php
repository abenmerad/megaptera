<form method="POST" id="form_connexion" action="index.php?uc=connexion&action=valider">
    <fieldset id="form1" form="form_connexion" class="container-fluid">
        <legend>Identification</legend>
        <div class="row form-group text-center">
            <label for="mdp">Identifiant</label>
            <div class="col-12 col-md-6" id="login">
                <input class="form-control"  type="text" name="login" maxlength="45" required>
            </div>
        </div>
        <div class="row form-group text-center">
            <label for="mdp">Mot de passe</label>
            <div class="col-12 col-md-6" id ="mdp">
                <input class="form-control"   type = "password"  aria-describedby="mdp_oublie" name = "mdp" maxlength="45" required>
                <small id="mdp_oublie" class="form-text text-muted"><a href="#">Mot de passe oublié ?</a></small>
            </div>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <p><input class="btn btn-primary" aria-describedby="creer_compte" type="submit" value="Valider"></p>
            <small id="creer_compte" class="form-text text-muted">
                <a href="#"><p>Devenez un observateur</p></a>
            </small>
        </div>
    </fieldset>
</form>
