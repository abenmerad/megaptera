<div class="container-fluid mt-5" id="matcher">
    <div class="row">
        <div class="col-md-6">
            <div id="carouselMatcher" value="<?= $observationPrimaire['codeObservation'] ?>" data-ride="carousel" style="border: 5px solid black;">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <figure class="figure">
                            <img src="<?= $observationPrimaire['nomPhoto'] ?>"  class="figure-img img-fluid rounded">
                            <div class="carousel-caption d-none d-md-block" style="color: black;">
                                <h5><?= $observationPrimaire['codeObservation'] ?></h5>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div id="carousselMatching" class="carousel" data-ride="carousel" style="border: 5px solid black;">
                <div class="carousel-inner">
                    <?php foreach($lesObservations as $key => $uneObservation): ?>
                        <?php if($uneObservation['codeObservation'] != $observationPrimaire['codeObservation']): ?>
                            <div class="carousel-item <?= ($key == 0) ? "active" : "" ?>">
                                <figure class="figure">
                                    <img src="<?= $uneObservation['nomPhoto'] ?>" class="figure-img img-fluid rounded">
                                    <div class="carousel-caption d-none d-md-block" style="color: black;">
                                        <h5><?= $uneObservation['codeObservation'] ?></h5>
                                    </div>
                                </figure>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="justify-content-md-between justify-content-sm-center text-center mb-5 mt-5" id="Button">
            <button class="btn btn-danger" value="not_matching" id="not_matching">Ecarter <i class="fas fa-times-circle"></i></button>
            <button class="btn btn-primary" value="matching" id="matching">Match <i class="fas fa-check"></i></button>
        </div>
    </div>
</div>