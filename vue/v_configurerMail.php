<form method="post"  action="index.php?uc=gestion&action=validerConfigurerServeur">
    <fieldset class="row">
        <legend>Configurer serveur mail</legend>
        <div class="form-group col col-md-6 mb-3">
            <label for="hote">Hôte</label>
            <input type="text" name="hote" id="hote" class="form-control" pattern="[a-zA-Z-.]{2,}" required>
        </div>
        <div class="form-group col col-md-6 mb-3">
            <label for="utilisateur">Mail utilisateur</label>
            <input type="email" name="utilisateur" id="utilisateur" class="form-control" required>
        </div>
        <div class="form-group col col-md-6 mb-3">
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" class="form-control" required>
        </div>
        <div class="form-group col col-md-6 mb-3">
            <label for="port">Port</label>
            <input type="number" name="port" id="port" class="form-control" required>
        </div>
        <div class="form-group col col-md-6 mb-3">
            <label for="encrypt">Encryptage</label>
            <select class="form-control" name="encrypt" id="encrypt">
                <option value="TLS">TLS</option>
                <option value="STMPS">SMTPS</option>
            </select>
        </div>
        <div class="form-group col col-md-6 mb-3">
            <label for="authSMTP">Authentification SMTP</label>
            <select class="form-control" name="authSMTP" id="authSMTP">
                <option value="true">Oui</option>
                <option value="false">Non</option>
            </select>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
        </div>
    </fieldset>
</form>