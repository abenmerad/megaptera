<div class="table-responsive-sm">
    <table class="table table-striped table-dark text-center">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Code</th>
            <th scope="col">Lieu</th>
            <th scope="col">Coordonnées géographique</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($lesLieux as $key => $unLieu): ?>
            <?php if($unLieu['code'] != 'AUT'): ?>
                <tr>
                    <th scope="row"><?= $key ?></th>
                    <td><?= $unLieu['code'] ?></td>
                    <td><?= $unLieu['lieu'] ?></td>
                    <td><?= ($unLieu['orientationLat'] == 'N') ? "Nord" : "Sud" ?>/<?= ($unLieu['orientationLong'] == "O") ? "Ouest" : "Est" ?></td>
                    <td>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="p-2">
                                <a href="index.php?uc=gestion&action=modifierLieu&code=<?= $unLieu['code'] ?>" title="Modifier le lieu" class="btn">
                                    <i class="fas fa-edit MD"></i>
                                </a>
                            </div>
                            <?php if(!$pdo -> getLesObservationsParLieu($unLieu['code'])): ?>
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
                                                    <p style="color: red;">Cette action est irreversible. Êtes-vous sûr de vouloir supprimer ce lieu ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <a href="index.php?uc=gestion&action=supprimerLieu&code=<?= $unLieu['code'] ?>">
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
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
        <a href="index.php?uc=gestion&action=ajouterLieu">
            <button class="btn btn-dark">Ajouter lieu</button>
        </a>
    </div>
</div>
