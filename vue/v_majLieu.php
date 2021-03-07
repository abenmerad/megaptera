<form id="formulaire" method="post" action='index.php?uc=gestion&action=confirmerModifierLieu&code=<?= $code ?>'>
	<fieldset class="container">
        <legend>Modifier lieu</legend>
        <div class="row form-group text-center">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="libLieu">Libelle du lieu</span>
                </div>
                <input type="text" class="form-control" name="lieu" placeholder="<?= $lieu ?>" aria-label="libLieu" aria-describedby="libLieu" pattern="[A-Za-zéèêà]{3,}" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="longitude">Longitude</span>
                </div>
                <select class="form-select" name="latitude">
                    <option value="">Latitude</option>
                    <option value="N" <?= ($latitude == 'N') ? "selected" : "" ?> >Nord</option>
                    <option value="S" <?= ($latitude == 'S') ? "selected" : "" ?> >Sud</option>
                </select>
                <select class="form-select" name="longitude">
                    <option value="">Longitude</option>
                    <option value="O" <?= ($longitude == 'O') ? "selected" : "" ?> >Ouest</option>
                    <option value="E" <?= ($longitude == 'E') ? "selected" : "" ?> >Est</option>
                </select>
            </div>
        </div>
        <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
            <input class="btn btn-primary" type="submit" value="Valider">
        </div>
	</fieldset>
</form>
	
		
					
       
                  
