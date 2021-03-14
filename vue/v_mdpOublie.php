<form action="index.php?uc=connexion&action=mdp_envoi_email" method="GET" id="form_mdp_oublie">
    <fieldset form="form_mdp_oublie" class="container-fluid">
        <legend>Mot de passe oublié</legend>
        <div class="row form-group justify-content-center text-center">
            <label for="mail">Entrez votre adresse mail</label>
            <div class="col-10 col-md-6">
                <input type="email" class="form-control" id="mail" name="mail" pattern="[a-zA-Z0-9.-_]+@[a-zA-Z.-_]+.[a-zA-Z.]{2,3}" required>
            </div>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <p><input class="btn btn-primary" type="submit" value="Valider"></p>
        </div>
    </fieldset>
</form>