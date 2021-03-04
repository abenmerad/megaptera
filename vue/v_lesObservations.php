<!--<div class="d-flex justify-content-center">-->
<!--    <div class="btn">-->
<!--        <i class="far fa-clipboard"></i>-->
<!--    </div>-->
<!--    <div class="btn">-->
<!--        <i class="fas fa-list"></i>-->
<!--    </div>-->
<!--</div>-->
<div class="text-center" id="resultat">Resultat de la recherche : <b><?= count($lesObservations) ?></b> observations trouvée(s)</div>
<div class="text-center">
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exportModal">
        EXPORT CSV
    </button>
    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="titre_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titre_modal">Export</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-exclamation-circle"></i> Seule les observations validées seront exportées.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                    <a title="Seules les observations validées seront exportées." href="index.php?uc=observation&action=export&annee=<?=$donnees['anneeObs']?>&groupe=<?=$donnees['groupeObs']?>&lieu=<?=$donnees['lieuObs']?>&couleur=<?=$donnees['couleurObs']?>&caudale=<?=$donnees['caudaleObs']?>&papillon=<?=$donnees['papillonObs']?>&min=<?=$donnees['minIndividus']?>&max=<?=$donnees['maxIndividus']?>">
                        <button id="export" class="btn btn-primary" >Continuer</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-around" id="clip-board">
    <?php foreach($lesObservations as $key => $uneObservation): ?>
        <div class="card bg-info mb-3 col-6 col-sm-3 col-md-2" style="width: 18rem;">
            <div class="card-img">
                <img src="<?= $uneObservation['nomPhoto'] ?>" alt="">
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $uneObservation['codeObservation'] ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?=($uneObservation['etatObservation'] == 'TR') ? "<i class=\"fas fa-clock TR\"></i> " . "En attente de validation <small>depuis le " . date("d/m/Y", strtotime($uneObservation['dateMAJ'])) . "</small>" : "<i class=\"fas fa-check-circle VA\"></i> " . "Validé " . "<small>le " . date("d/m/Y", strtotime($uneObservation['dateDeValidite'])) . "</small>" ?></h6>
                <p class="card-text "><?= $uneObservation['commentaire'] ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Auteur :</b> <?= $uneObservation['prenomMembre'] . ' ' . $uneObservation['nomMembre'] ?></li>
                <li class="list-group-item"><b>Observé le :</b> <?= date('d/m/Y', strtotime($uneObservation['dateObservation'])) . ' entre ' . $uneObservation['heureDebutObservation'] . ' et ' . $uneObservation['heureFinObservation']?></li>
                <li class="list-group-item"><b>Lieu :</b> <?= $uneObservation['libLieu'] ?></li>
                <li class="list-group-item"><b>Coordonnées :</b> <?= $uneObservation['latitude'] . ', ' . $uneObservation['longitude']?></li>
            </ul>
            <div class="card-body text-center">
                <button data-toggle="modal" data-target="#consultation_modal<?= $key ?>" class="btn btn-primary">
                    Consulter
                </button>
            </div>
        </div>
        <div class="modal fade" id="consultation_modal<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="consultation_modal_title<?= $key ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="consultation_modal_title<?= $key ?>"><?= $uneObservation['codeObservation'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <article class="row text-center" id="consultation">
                            <section class="col col-md-12" id="section_carousel">
                                <figure class="figure">
                                    <img src="<?= $uneObservation['nomPhoto'] ?>" class="figure-img img-fluid rounded">
                                    <figcaption class="figure-caption"><?= htmlspecialchars($uneObservation['commentaire']) ?></figcaption>
                                </figure>
                            </section>
                            <section class="col-md-12 info_consultation">
                                <h4>Groupe</h4>
                                <p><?= $uneObservation['libGroupe'] ?></p>
                            </section>
                            <section class="col-md-12 info_consultation">
                                <h4>Couleur dominante</h4>
                                <p><?= $uneObservation['libDominante'] ?></p>
                            </section>
                            <section class="col-md-12 info_consultation">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Heure début observation</h4>
                                        <p><?= $uneObservation['heureDebutObservation'] ?>
                                    </div>
                                    <div class="col-md-4">
                                        <i id="to_heure" class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>Heure fin observation</h4>
                                        <p><?= $uneObservation['heureFinObservation'] ?></p>
                                    </div>
                                </div>
                            </section>
                            <section class="col-md-12 info_consultation">
                                <h4>Date d'observation</h4>
                                <p><?= date('d/m/Y', strtotime($uneObservation['dateObservation'])) ?></p>
                            </section>
                            <section class="col-md-12 info_consultation">
                                <h4>Coordonnées GPS</h4>
                                <p><?= $uneObservation['latitude'] . ' ' . $uneObservation['longitude'] ?></p>
                            </section>
                            <section class="col-md-12 info_consultation">
                                <h4>Nombre d'individus recensés</h4>
                                <p><?= $uneObservation['nbIndividus'] ?></p>
                            </section>
                            <section class="col-md-12 info_consultation">
                                <h4>Présence d'un papillon</h4>
                                <p><?= $uneObservation['papillon'] ?></p>
                            </section>
                            <section class="col-md-12 info_consultation">
                                <h4>Type de caudale</h4>
                                <p><?= $uneObservation['typeCaudale'] ?></p>
                            </section>
                            <section class="col-md-12 info_consultation">
                                <h4>Comportement</h4>
                                <p><?= htmlspecialchars($uneObservation['comportement']) ?></p>
                            </section>
                        </article>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                        <?php if($_SESSION['poste'] == "menuSuper" || $_SESSION['poste'] == "menuAdmin"): ?>
                            <a href="index.php?uc=<?= $_SESSION['poste'] ?>&action=rechercheMatching&id=<?= $uneObservation['codeObservation'] ?>" class="btn btn-primary">Matching</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!--<div class="d-flex justify-content-center" id="table-board">-->
<!--    <table class="table table-striped text-center">-->
<!--        <thead>-->
<!--            <tr>-->
<!--                <th scope="col">#</th>-->
<!--                <th scope="col">Code Observation</th>-->
<!--                <th scope="col">Etat</th>-->
<!--                <th scope="col">Observé le</th>-->
<!--                <th scope="col">Lieu</th>-->
<!--                <th scope="col">Coordonnées</th>-->
<!--            </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--                --><?php //foreach($lesObservations as $key => $uneObservation): ?>
<!--                    <a href="#">-->
<!--                        <tr>-->
<!--                            <th scope="row"><b>--><?//= $key ?><!--</b></th>-->
<!--                            <td>--><?//= $uneObservation['codeObservation'] ?><!--</td>-->
<!--                            <td>--><?//=($uneObservation['etatObservation'] == 'TR') ? "En attente de validation" : "Validé" ?><!--</td>-->
<!--                            <td>--><?//= date('d/m/Y', strtotime($uneObservation['dateObservation'])) . ' entre ' . $uneObservation['heureDebutObservation'] . ' et ' . $uneObservation['heureFinObservation']?><!--</td>-->
<!--                            <td>--><?//= $uneObservation['libLieu'] ?><!--</td>-->
<!--                            <td>--><?//= $uneObservation['latitude'] . ', ' . $uneObservation['longitude']?><!--</td>-->
<!---->
<!--                        </tr>-->
<!--                    </a>-->
<!--                --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->
<!--</div>-->
