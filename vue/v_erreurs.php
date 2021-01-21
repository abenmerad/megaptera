
<div class="erreurs">
    <?php $errs = (empty($_SESSION['erreurs'])) ? [] : $_SESSION['erreurs']; ?>
    <ul>
        <?php foreach($errs as $erreur): ?>
            <li><?= $erreur ?></li>
        <?php endforeach; ?>
    </ul>
</div>