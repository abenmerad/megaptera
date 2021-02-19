<form method="POST" id="form_connexion" action="index.php?uc=connexion&action=valider">
    <fieldset form="form_connexion" class="container-fluid">
    <legend>Connexion</legend>
        <div class="row form-group text-center">
            <label for="login">Identifiant</label>
            <div class="col-12 col-md-6" id="login">
                <input class="form-control"  type="text" name="login" maxlength="45" required>
            </div>
        </div>
        <div class="row form-group text-center">
            <label for="mdp">Mot de passe</label>
            <div class="col-12 col-md-6" id ="mdp">
                <input class="form-control" type="password" aria-describedby="mdp_oublie" name = "mdp" maxlength="45" required>
                <small id="mdp_oublie" class="form-text text-muted"><a href="index.php?action=mdp_oublie">Mot de passe oublié ?</a></small>
            </div>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <p><input class="btn btn-primary" type="submit" value="Valider"></p>
        </div>
    </fieldset>
</form>

    