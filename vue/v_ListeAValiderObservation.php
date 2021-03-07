<?php if(!empty($lesObservations)): ?>
    <div class="table-responsive-sm">
        <table class="table table-striped table-dark text-center" id="obsAValider">
            <caption>Liste des observations à valider</caption>
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">Observation</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($lesObservations as $key => $uneObservation): ?>
                <tr>
                    <th scope="row"><?= $key ?></th>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#image_obsModal<?= $key ?>">
                            Image
                        </button>
                        <div class="modal fade" id="image_obsModal<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="image_obsModalTitre<?= $key ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="image_obsModalTitre<?= $key ?>">Image</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <figure class="figure">
                                            <img src="<?= $uneObservation['nomPhoto'] ?>" class="figure-img img-fluid rounded">
                                            <figcaption class="figure-caption"><?= $uneObservation['codeObservation'] . " " . $uneObservation['nomPhoto'] ?></figcaption>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-primary">
                                <b>Nom de l'observation : </b> <?= $uneObservation['codeObservation'] ?>
                            </li>
                            <li class="list-group-item list-group-item-primary">
                                <b>Auteur : </b><?= $uneObservation['nom'] . ' ' . $uneObservation['prenom'] ?>
                            </li>
                            <li class="list-group-item list-group-item-primary">
                                <b>Date de création : </b> <?= $uneObservation['dateMAJ'] ?>
                            </li>
                            <li class="list-group-item list-group-item-primary">
                                <b>Lieu : </b> <?= $uneObservation['libLieu'] ?>
                            </li>
                            <li class="list-group-item list-group-item-primary">
                                <b>Coordonnées : </b><?= $uneObservation['latitude'] . " " . $uneObservation['longitude'] ?>
                            </li>
                            <li class="list-group-item list-group-item-primary">
                                <b>Date observation : </b> <?= date("d/m/Y", strtotime($uneObservation['dateObservation'])) ?>
                            </li>
                            <li class="list-group-item list-group-item-primary">
                                <b>Plage horaire : </b> Entre <?= $uneObservation['heureDebutObservation'] ?> et <?= $uneObservation['heureFinObservation'] ?>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center">
                            <?php if($_SESSION['poste'] == "superAdmin"): ?>
                                <div class="p-2">
                                    <a href="index.php?uc=gestion&action=modifierObservation&code=<?= $uneObservation['codeObservation'] ?>" title="Modifier l'observation" class="btn <?= ($uneObservation['lieuObservation'] == "AUT" && $_SESSION['poste'] != "superAdmin") ? "disabled" : '' ?>">
                                        <i class="fas fa-edit MD"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="p-2">
                                <a href="" title="Refuser l'observation" class="btn <?= ($uneObservation['lieuObservation'] == "AUT" && $_SESSION['poste'] != "superAdmin") ? "disabled" : '' ?>">
                                    <i class="fas fa-times-circle ER"></i>
                                </a>
                            </div>
                            <div class="p-2">
                                <a href="index.php?uc=gestion&action=confirmerValiderUneObservation&code=<?= $uneObservation['codeObservation'] ?>" title="Valider l'observation" class="btn <?= ($uneObservation['lieuObservation'] == "AUT" || $_SESSION['poste'] != "superAdmin" && $uneObservation['lieuObservation'] == "AUT") ? "disabled" : '' ?>">
                                    <i class="fas fa-check-square VA"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="text-center" style="color: red; font-size: 15px; width: 50%; border: 2px solid red; margin: 0 auto; border-radius: 5px;">
        <i class="fas fa-exclamation-circle"></i> Aucune observation n'est à valider pour l'instant. Revenez plus tard...
    </div>
<?php endif; ?>
