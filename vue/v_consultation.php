<article class="row text-center" id="consultation">
    <section class="col-md-12">
        <h1><?= $monObservation['codeObservation'] ?></h1>
    </section>
    <section class="col col-md-12" id="section_carousel">
        <button class="btn btn-primary text-center" type="button" data-toggle="collapse" data-target="#carousel_observation" aria-expanded="false">
            Caroussel
        </button>
        <div id="carousel_observation" class="carousel slide collapse" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach($img_obs as $k => $img):?>
                    <div class="carousel-item <?= ($k == 0) ? "active" : ""?>">
                        <img class="d-block w-100" src="images/<?= $monObservation['CodeLieu'] . '/' . $monObservation['codeObservation'] . '/' . $img ?>" alt="First slide">
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carousel_observation" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel_observation" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <section class="col-md-12 info_consultation">
        <h4>Groupe</h4>
        <p><?= $monObservation['Groupe'] ?></p>
    </section>
    <section class="col-md-12 info_consultation">
        <h4>Couleur dominante</h4>
        <p><?= $monObservation['Dominante'] ?></p>
    </section>
    <section class="col-md-12 info_consultation">
        <div class="row">
            <div class="col-md-4">
                <h4>Heure début observation</h4>
                <p><?= $monObservation['heureDebutObservation'] ?>
            </div>
            <div class="col-md-4">
                <i id="to_heure" class="fa fa-arrow-right" aria-hidden="true"></i>
            </div>
            <div class="col-md-4">
                <h4>Heure fin observation</h4>
                <p><?= $monObservation['heureFinObservation'] ?></p>
            </div>
        </div>
    </section>
    <section class="col-md-12 info_consultation">
        <h4>Date d'observation</h4>
        <p><?= date('d/m/Y', strtotime($monObservation['dateObservation'])) ?></p>
    </section>
    <section class="col-md-12 info_consultation">
        <h4>Coordonnées GPS</h4>
        <p><?= $monObservation['latitude'] . ' ' . $monObservation['longitude'] ?></p>
    </section>
    <section class="col-md-12 info_consultation">
        <h4>Nombre d'individus recensés</h4>
        <p><?= $monObservation['nbIndividus'] ?></p>
    </section>
    <section class="col-md-12 info_consultation">
        <h4>Présence d'un papillon</h4>
        <p><?= $monObservation['papillon'] ?></p>
    </section>
    <section class="col-md-12 info_consultation">
        <h4>Type de caudale</h4>
        <p><?= $monObservation['typeCaudale'] ?></p>
    </section>
    <section class="col-md-12 info_consultation">
        <h4>Commentaire</h4>
        <p><?= $monObservation['commentaire'] ?></p>
    </section>
    <section class="col-md-12 info_consultation">
        <h4>Comportement</h4>
        <p><?= $monObservation['comportement'] ?></p>
    </section>
</article>