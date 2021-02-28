<div class="table-responsive-sm">
    <table class="table table-striped table-dark text-center">
        <caption>Liste des groupes</caption>
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Code</th>
            <th scope="col">Libellé</th>
            <th scope="col">Opérateur - Valeur</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($lesGroupes as $key => $unGroupe): ?>
            <tr>
                <th scope="row"><?= $key ?> </th>
                <td><?= $unGroupe['code'] ?></td>
                <td><?= $unGroupe['libelle'] ?></td>
                <td><?= $unGroupe['operateur'] . " " . $unGroupe['valeur'] ?></td>
                <td>
                    <div class="d-flex flex-row justify-content-center">
                        <div class="p-2">
                            <a href="index.php?uc=<?=$_SESSION['poste']?>&action=modifierGroupe&code=<?= $unGroupe['code'] ?>" title="Modifier le groupe" class="btn">
                                <i class="fas fa-edit MD"></i>
                            </a>
                        </div>
                        <div class="p-2">
                            <a href="" data-toggle="modal" data-target="#supprimerGrp" title="Supprimer le groupe" class="btn">
                                <i class="fas fa-times-circle ER"></i>
                            </a>
                            <div class="modal fade" id="supprimerGrp<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="#supprimerGrpTitre<?= $key ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="supprimerGrpTitre<?= $key ?>" style="color: red;"><i class="fas fa-exclamation-circle"></i> Attention</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p style="color: red;">Cette action est irreversible. Êtes-vous sûr de vouloir supprimer ce groupe ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <a href="index.php?uc=<?= $_SESSION['poste'] ?>&action=supprimerGroupe&code=<?= $unGroupe['code'] ?>">
                                                <button type="button" class="btn btn-primary">Supprimer</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="justify-content-md-center justify-content-sm-center text-center" id="Button">
        <a href="index.php?uc=<?= $_SESSION['poste'] ?>&action=ajouterGroupe">
            <button class="btn btn-dark">Ajouter groupe</button>
        </a>
    </div>
</div>