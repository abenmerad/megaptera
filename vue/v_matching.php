<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-6">
            <div id="carouselMatcher" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <figure class="figure">
                            <img src="<?= $observationPrimaire['nomPhoto'] ?>" style="border: 5px solid black;" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                            <div class="carousel-caption d-none d-md-block" style="color: black;">
                                <h5><?= $observationPrimaire['codeObservation'] ?></h5>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div id="carousselMatching" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach($lesObservations as $key => $uneObservation): ?>
                        <?php if($uneObservation['codeObservation'] != $observationPrimaire['codeObservation']): ?>
                            <div class="carousel-item active">
                                <figure class="figure">
                                    <img src="<?= $uneObservation['nomPhoto'] ?>" style="border: 5px solid black;" class="figure-img img-fluid rounded">
                                    <div class="carousel-caption d-none d-md-block" style="color: black;">
                                        <h5><?= $uneObservation['codeObservation'] ?></h5>
                                        <p>
                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalMatching<?= $key ?>">
                                                Comparer
                                            </button>
                                            <div class="modal fade" id="modalMatching<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="modalMatchingTitre<?= $key ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalMatchingTitre<?= $key ?>"><?= $observationPrimaire['codeObservation']?> - <?= $uneObservation['codeObservation'] ?> </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <article class="row text-center" id="consultation">
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4><?= $observationPrimaire['codeObservation'] ?></h4>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4>Groupe</h4>
                                                                                <p><?= $observationPrimaire['libGroupe'] ?></p>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4>Couleur dominante</h4>
                                                                                <p><?= $observationPrimaire['libDominante'] ?></p>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation h-25">
                                                                                    <div class="col-md-12">
                                                                                        <h4>Heure début observation</h4>
                                                                                        <p><?= $observationPrimaire['heureDebutObservation'] ?>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <i id="to_heure" class="fa fa-arrow-right" aria-hidden="true"></i>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <h4>Heure fin observation</h4>
                                                                                        <p><?= $observationPrimaire['heureFinObservation'] ?></p>
                                                                                    </div>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4>Date d'observation</h4>
                                                                                <p><?= date('d/m/Y', strtotime($observationPrimaire['dateObservation'])) ?></p>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4>Coordonnées GPS</h4>
                                                                                <p><?= $observationPrimaire['latitude'] . ' ' . $observationPrimaire['longitude'] ?></p>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4>Nombre d'individus recensés</h4>
                                                                                <p><?= $observationPrimaire['nbIndividus'] ?></p>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4>Présence d'un papillon</h4>
                                                                                <p><?= $observationPrimaire['papillon'] ?></p>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4>Type de caudale</h4>
                                                                                <p><?= $observationPrimaire['typeCaudale'] ?></p>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4>Comportement</h4>
                                                                                <p><?= htmlspecialchars($observationPrimaire['comportement']) ?></p>
                                                                            </section>
                                                                        </article>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <article class="text-center" id="consultation">
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4><?= $uneObservation['codeObservation'] ?></h4>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4>Groupe</h4>
                                                                                <p><?= $uneObservation['libGroupe'] ?></p>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation">
                                                                                <h4>Couleur dominante</h4>
                                                                                <p><?= $uneObservation['libDominante'] ?></p>
                                                                            </section>
                                                                            <section class="col-md-12 info_consultation h-25">
                                                                                    <div class="col-md-12">
                                                                                        <h4>Heure début observation</h4>
                                                                                        <p><?= $uneObservation['heureDebutObservation'] ?>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <i id="to_heure" class="fa fa-arrow-right" aria-hidden="true"></i>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <h4>Heure fin observation</h4>
                                                                                        <p><?= $uneObservation['heureFinObservation'] ?></p>
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </figure>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="justify-content-md-between justify-content-sm-center text-center mb-5" id="Button">
            <button class="btn btn-danger">Ecarter <i class="fas fa-times-circle"></i></button>
            <button class="btn btn-primary">Match <i class="fas fa-check"></i></button>
        </div>
    </div>
</div>