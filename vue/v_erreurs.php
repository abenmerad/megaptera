<div class="container" id="erreurs">
    <div class="row">
        <ul class="col-md-8 col-12">
            <?php foreach($_SESSION['erreurs'] as $erreur): ?>
                <li><?= $erreur ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>