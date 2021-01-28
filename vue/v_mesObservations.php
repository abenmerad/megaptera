<div class="text-center" id="resultat">Resultat de la recherche : <b><?= count($lesObservations) ?></b> observations trouvées</div>
<div class="text-center"><a title="Seules les observations validées seront exportées." href="index.php?uc=<?=$_SESSION['poste'] ?>&action=export&annee=<?=$donnees['anneeObs']?>&etat=<?=$donnees['etatObs']?>&groupe=<?=$donnees['groupeObs']?>&lieu=<?=$donnees['lieuObs']?>"><button id="export" class="btn btn-outline-primary">Export CSV</button></a></div>
<div class="row justify-content-around">
    <?php foreach($lesObservations as $uneObservation): ?>
        <div class="card col-6 col-sm-3 col-md-2" style="width: 18rem;">
            <div class="card-img">
                <img width="100" height="200" class="card-img-top" src="images/<?= $uneObservation['lieuObservation'] . '/' . $uneObservation['codeObservation'] . '/' . explode(";", $uneObservation['nomPhoto'])[0] ?>" alt="<?= $uneObservation['codeObservation'] ?>">
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $uneObservation['codeObservation'] ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $etat = ($uneObservation['etatObservation'] == 'TR') ? "En attente de validation" : "Validé" ?></h6>
                <p class="card-text "><?= $uneObservation['commentaire'] ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Observé le :</b> <?= date('d/m/Y', strtotime($uneObservation['dateObservation'])) . ' entre ' . $uneObservation['heureDebutObservation'] . ' et ' . $uneObservation['heureFinObservation']?></li>
                <li class="list-group-item"><b>Lieu :</b> <?= $uneObservation['libLieu'] ?></li>
                <li class="list-group-item"><b>Coordonnées :</b> <?= $uneObservation['latitude'] . ', ' . $uneObservation['longitude']?></li>
            </ul>
            <div class="card-body text-center">
                <a href="#" class="btn btn-primary">Consulter</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
