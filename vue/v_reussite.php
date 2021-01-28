<div class="reussite">
    <?php $reussite = (isset($_SESSION['reussite']) && empty($_SESSION['reussite'])) ? [] : $_SESSION['reussite']; ?>
    <ul>
        <?php foreach($errs as $erreur): ?>
            <li><?= $erreur ?></li>
        <?php endforeach; ?>
    </ul>
</div>