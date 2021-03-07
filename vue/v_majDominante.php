<form method="post" action='index.php?uc=gestion&action=confirmerModifierDominante&id=<?= $uneDominante['id'] ?>'>
    <fieldset class="container">
        <legend>Modifier dominante</legend>
        <div class="row form-group text-center">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="libDominante">Libelle de la dominante</span>
                </div>
                <input type="text" class="form-control" name="libelle" placeholder="<?= $uneDominante['libelle'] ?>" aria-label="libDominante" aria-describedby="libDominante" pattern="[A-Za-zéèêà]{3,}" required>
            </div>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
        </div>
    </fieldset>
</form>
		
