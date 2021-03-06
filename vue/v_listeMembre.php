<div class="table-responsive-sm">
    <table class="table table-striped table-dark text-center">
        <caption>Liste des membres</caption>
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Login</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Courriel</th>
            <th scope="col">Poste</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($lesMembres as $key => $unMembre): ?>
            <tr>
                <th scope="row"><?= $key ?> </th>
                <td><?= $unMembre['nom'] ?></td>
                <td><?= $unMembre['prenom'] ?></td>
                <td><?= $unMembre['login'] ?></td>
                <td><?= $unMembre['tel'] ?></td>
                <td><?= $unMembre['mail'] ?></td>
                <td><?= $unMembre['poste'] ?></td>
                <td>
                    <div class="d-flex flex-row justify-content-center">
                        <div class="p-2">
                            <a href="index.php?uc=gestion&action=modifierMembre&id=<?= $unMembre['id'] ?>" title="Modifier le membre" class="btn <?= ($_SESSION['poste'] == "Admin" && $unMembre['poste'] != "Membre" ) ? "disabled" : "" ?>">
                                <i class="fas fa-edit MD"></i>
                            </a>
                        </div>
                        <?php if(!$pdo -> getLesObservationsParMembre($unMembre['id'])): ?>
                            <div class="p-2">
                                <a href="#" data-toggle="modal" data-target="#supprimerMembre<?= $key ?>" title="Supprimer le membre" class="btn <?= ($_SESSION['poste'] == "Admin" && $unMembre['poste'] != "Membre") ? "disabled" : "" ?>">
                                    <i class="fas fa-times-circle ER"></i>
                                </a>
                                <div class="modal fade" id="supprimerMembre<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="#supprimerMembreTitre<?= $key ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="supprimerMembreTitre<?= $key ?>" style="color: red;"><i class="fas fa-exclamation-circle"></i> Attention</h5>
                                            </div>
                                            <div class="modal-body">
                                                <p style="color: red;">Cette action est irreversible. Êtes-vous sûr de vouloir supprimer ce membre ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <a href="index.php?uc=gestion&action=supprimerMembre&id=<?= $unMembre['id'] ?>">
                                                    <button type="button" class="btn btn-primary">Supprimer</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
        <a href="index.php?uc=gestion&action=ajouterMembre">
            <button class="btn btn-dark">Ajouter membre</button>
        </a>
    </div>
</div>