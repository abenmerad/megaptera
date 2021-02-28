<form id="formulaire" method="post" action='index.php?uc=<?= $_SESSION['poste'] ?>&action=confirmerAjouterDominante'>
    <fieldset class="container">
        <legend>Ajouter couleur dominante</legend>
        <div class="row form-group text-center">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="libDominante">Libelle de la couleur dominante</span>
                </div>
                <input type="text" class="form-control" name="libelle" aria-label="libDominante" aria-describedby="libDominante" pattern="[A-Za-zéèêà]{3,}" required>
            </div>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
        </div>
    </fieldset>
</form>

