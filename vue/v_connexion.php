<form method="POST" id="form_connexion" action="index.php?uc=connexion&action=valider">
    <fieldset id="form1" form="form_connexion" class="container-fluid">
    <legend>Identification</legend>
        <div class="row form-group text-center">
            <label for="mdp">E-mail *</label>
            <div class="col-12 col-md-6" id="login">
                <input class="form-control"  type="email" name="login" maxlength="45" required>
            </div>
        </div>
        <div class="row form-group text-center">
            <label for="mdp">Mot de passe *</label>
            <div class="col-12 col-md-6" id ="mdp">
                <input class="form-control"   type = "password"  name = "mdp" maxlength="45" required>
            </div>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
        </div>
    </fieldset>
</form>

    