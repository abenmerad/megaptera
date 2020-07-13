
	<form method="POST" action="index.php?uc=connexion&action=valider">
	<div class="container form-group">
					<div class="row">
						<div class="col-md-12">
							<fieldset>
							<div class="col-md-12">
								<h1>Identification</h1>
								<div class="row">
									<label for = "nom">Login*</label>
									<input id = "login" type = "text" name = "login"  size = "30" maxlength = "45" required >
								</div>
								<div class="col-md-12">
									<label for = "mdp">Mot de passe*</label>
									<input id = "mdp"  type = "password"  name = "mdp" size = "30" maxlength = "45" required>
								</div>
								</div>
							</fieldset>
						</div>
						<div class="row">
								<div class="col-md-6"><input type = "submit" value = "Valider" name = "valider"></div>
								<div class="col-md-6"><input type = "reset" value = "Annuler" name = "annuler"></div>
						</div>
					</div>
	</div>
	</form>

    