<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="img/avatar/default.jpg" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?=$unMembre['prenom']?>  <?=$unMembre['nom']?> </h4>
                                <p class="text-secondary mb-1"><?=($unMembre['poste'] == "superAdmin") ? "Super Admin" : $unMembre['poste']?></p>
                                <button class="btn btn-outline-primary">Message</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Nom</h6>
                            <span class="text-secondary"><?=$unMembre['nom']?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Prénom</h6>
                            <span class="text-secondary"><?=$unMembre['prenom']?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">E-mail</h6>
                            <span class="text-secondary"><?=$unMembre['mail']?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Mobile</h6>
                            <span class="text-secondary"><?=$unMembre['tel']?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5><?=($_SESSION['id'] == $unMembre['id']) ? "Vos observations" : "Les observations de " . $unMembre['prenom']?></h5>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Code observation</th>
                                    <th scope="col">Lieu</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Coordonnées</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($lesObservations as $key => $uneObservation):?>
                                    <tr>
                                        <td><?=$uneObservation['codeObservation']?></td>
                                        <td><?=$uneObservation['lieuObservation']?></td>
                                        <td><?=$uneObservation['dateObservation']?></td>
                                        <td><?=$uneObservation['latitude']?> <?=$uneObservation['longitude']?> </td>
                                        <td><a href="#" data-toggle="modal" data-target="#consultationProfil<?=$key?>"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                    <div class="modal fade" id="consultationProfil<?=$key?>" tabindex="-1" role="dialog" aria-labelledby="consultation_title<?=$key?>" aria-hidden="true" data-backdrop="false">
                                        <div class="modal-dialog modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="consultation_title<?=$key?>"><?=$uneObservation['codeObservation']?></h5>
                                                </div>
                                                <div class="modal-body">
                                                    <article class="row text-center" id="consultation">
                                                        <section class="col col-md-12" id="section_carousel">
                                                            <figure class="figure">
                                                                <img src="<?="images/" . $uneObservation['lieuObservation'] . '/' .$uneObservation['nomPhoto']?>" class="figure-img img-fluid rounded">
                                                                <figcaption class="figure-caption"><?=htmlspecialchars($uneObservation['commentaire'])?></figcaption>
                                                            </figure>
                                                        </section>
                                                        <section class="col-md-12 info_consultation">
                                                            <h4>Groupe</h4>
                                                            <p><?=$uneObservation['libGroupe']?></p>
                                                        </section>
                                                        <section class="col-md-12 info_consultation">
                                                            <h4>Couleur dominante</h4>
                                                            <p><?=$uneObservation['libDominante']?></p>
                                                        </section>
                                                        <section class="col-md-12 info_consultation">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <h4>Heure début observation</h4>
                                                                    <p><?=$uneObservation['heureDebutObservation']?>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <i id="to_heure" class="fa fa-arrow-right" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h4>Heure fin observation</h4>
                                                                    <p><?=$uneObservation['heureFinObservation']?></p>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <section class="col-md-12 info_consultation">
                                                            <h4>Date d'observation</h4>
                                                            <p><?=date('d/m/Y', strtotime($uneObservation['dateObservation']))?></p>
                                                        </section>
                                                        <section class="col-md-12 info_consultation">
                                                            <h4>Coordonnées GPS</h4>
                                                            <p><?=$uneObservation['latitude'] . ' ' . $uneObservation['longitude']?></p>
                                                        </section>
                                                        <section class="col-md-12 info_consultation">
                                                            <h4>Nombre d'individus recensés</h4>
                                                            <p><?=$uneObservation['nbIndividus']?></p>
                                                        </section>
                                                        <section class="col-md-12 info_consultation">
                                                            <h4>Présence d'un papillon</h4>
                                                            <p><?=$uneObservation['papillon']?></p>
                                                        </section>
                                                        <section class="col-md-12 info_consultation">
                                                            <h4>Type de caudale</h4>
                                                            <p><?=$uneObservation['typeCaudale']?></p>
                                                        </section>
                                                        <section class="col-md-12 info_consultation">
                                                            <h4>Comportement</h4>
                                                            <p><?=htmlspecialchars($uneObservation['comportement'])?></p>
                                                        </section>
                                                    </article>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>