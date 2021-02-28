<div class="container" id="erreurs">
    <div class="row">
        <ul class="col-md-8 col-12">
            <?php foreach($_SESSION['erreurs'] as $erreur): ?>
                <li><i class="fas fa-exclamation-circle"></i>  <?= $erreur ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>