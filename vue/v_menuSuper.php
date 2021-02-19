<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav justify-content-around" id="menu">
            <li class="nav-item active"><a class="nav-link" href="#">Accueil</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Observations</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=validerObservation">Observation à valider</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=filtre">Rechercher</a>
                </div>
            </li>
            <li class="nav-item active"><a class="nav-link" href="index.php?uc=<?=$_SESSION['poste']?>&action=listeMembre">Membre</a></li>
            <li class="nav-item active"><a class="nav-link" href="index.php?uc=<?=$_SESSION['poste']?>&action=listeLieu">Lieu</a></li>
            <li class="nav-item active"><a class="nav-link" href="index.php?uc=<?=$_SESSION['poste']?>&action=listeGroupe">Groupe</a></li>
            <li class="nav-item active"><a class="nav-link" href="index.php?uc=<?=$_SESSION['poste']?>&action=listeDominante">Dominante</a></li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?uc=connexion&action=deconnexion">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>