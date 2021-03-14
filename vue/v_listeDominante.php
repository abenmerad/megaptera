<div class="table-responsive-sm">
    <table class="table table-striped table-dark text-center">
        <caption>Liste des couleurs dominantes</caption>
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Code</th>
            <th scope="col">Libellé</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($lesDominantes as $key => $uneDominante): ?>
            <tr>
                <th scope="row"><?= $key ?> </th>
                <td><?= $uneDominante['id'] ?></td>
                <td><?= $uneDominante['libelle'] ?></td>
                <td>
                    <div class="d-flex flex-row justify-content-center">
                        <div class="p-2">
                            <a href="index.php?uc=gestion&action=modifierDominante&id=<?= $uneDominante['id'] ?>" title="Modifier la couleur dominante" class="btn">
                                <i class="fas fa-edit MD"></i>
                            </a>
                        </div>
                        <?php if(!$pdo -> getLesObservationsParDominante($uneDominante['id'])): ?>
                            <div class="p-2">
                                <a href="" data-toggle="modal" data-target="#supprimerDom<?= $key ?>" title="Supprimer le groupe" class="btn">
                                    <i class="fas fa-times-circle ER"></i>
                                </a>
                                <div class="modal fade" id="supprimerDom<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="#supprimerDomTitre<?= $key ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="supprimerDomTitre<?= $key ?>" style="color: red;"><i class="fas fa-exclamation-circle"></i> Attention</h5>
                                            </div>
                                            <div class="modal-body">
                                                <p style="color: red;">Cette action est irreversible. Êtes-vous sûr de vouloir supprimer cette dominante ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <a href="index.php?uc=gestion&action=supprimerDominante&idDominante=<?= $uneDominante['id'] ?>">
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
        <a href="index.php?uc=gestion&action=ajouterDominante">
            <button class="btn btn-dark">Ajouter dominante</button>
        </a>
    </div>
</div>