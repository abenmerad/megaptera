<form id="formulaire" method="post" action='index.php?uc=gestion&action=confirmerAjouterLieu'>
    <fieldset class="container">
        <legend>Ajouter lieu</legend>
        <div class="row form-group text-center">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="libLieu">Libelle du lieu</span>
                </div>
                <input type="text" class="form-control" name="lieu" placeholder="Exemple : Comores" aria-label="libLieu" aria-describedby="libLieu" pattern="[A-Za-z]{3,13}" maxlength="13" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Coordonnées géographique</span>
                </div>
                <select class="form-select" name="latitude">
                    <option value="">Latitude</option>
                    <option value="N">Nord</option>
                    <option value="S">Sud</option>
                </select>
                <select class="form-select" name="longitude">
                    <option value="">Longitude</option>
                    <option value="O">Ouest</option>
                    <option value="E">Est</option>
                </select>
            </div>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
        </div>
    </fieldset>
</form>
		