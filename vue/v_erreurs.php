<div class="container" id="erreurs">
    <div class="row">
        <?php $errs = (empty($_SESSION['erreurs'])) ? [] : $_SESSION['erreurs']; ?>
        <ul class="col-md-8 col-12">
            <?php foreach($errs as $erreur): ?>
                <li><?= $erreur ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>