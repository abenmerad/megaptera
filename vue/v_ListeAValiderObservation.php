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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#image_obsModal">
                        Image
                    </button>
                    <div class="modal fade" id="image_obsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Image</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="carousel_card" class="carousel slide w-20" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php foreach(explode(";", $uneObservation['nomPhoto']) as $keys => $img): ?>
                                                <div class="carousel-item <?= ($key == 0) ? "active" : ""?>">
                                                    <img class="card-img-top d-block w-100" src="images/<?= $uneObservation['lieuObservation'] . '/' . $uneObservation['codeObservation'] . '/' . $img ?>">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
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
                        <div class="p-2">
                            <a href="index.php?uc=<?=$_SESSION['poste']?>&action=modifierObservation&code=<?= $uneObservation['codeObservation'] ?>" title="Modifier l'observation" class="btn">
                                <i class="fas fa-edit MD"></i>
                            </a>
                        </div>
                        <div class="p-2">
                            <a href="" title="Refuser l'observation" class="btn">
                                <i class="fas fa-times-circle ER"></i>
                            </a>
                        </div>
                        <div class="p-2">
                            <a href="index.php?uc=<?=$_SESSION['poste']?>&action=confirmerValiderUneObservation&code=<?= $uneObservation['codeObservation'] ?>" title="Valider l'observation" class="btn <?= ($uneObservation['lieuObservation'] == "AUT" ? "disabled" : '')?>">
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