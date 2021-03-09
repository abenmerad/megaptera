<form method="POST" action="index.php?uc=connexion&action=validerModifierMdp&id=<?= $_GET['id'] ?>&token=<?= $_GET['token'] ?>" class="container">
    <fieldset class="row">
        <legend>
            Modifier mot de passe
            <a href="" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-info-circle"></i>
            </a>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="titreModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="titreModal">Information matching</h5>
                        </div>
                        <div class="modal-body">
                            Le mot de passe doit avoir au moins 8 caractères ou plus dont au moins :
                            <ul>
                                <li>Une lettre majuscule</li>
                                <li>Une lettre minuscule</li>
                                <li>Un nombre</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </legend>
        <div class="form-group">
            <label for="mdp">Nouveau mot de passe</label>
            <input type="password" class="form-control" name="mdp" id="mdp" required>
        </div>
        <div class="form-group">
            <label for="mdp_repeat">Répeter nouveau mot de passe</label>
            <input type="password" class="form-control" name="mdp_repeat" id="mdp_repeat" required>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
        </div>
    </fieldset>
</form>