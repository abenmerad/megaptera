<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav justify-content-around" id="menu">
            <li class="nav-item active">
                <a class="nav-link" href="#">Accueil</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Observations
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=validerObservation">Valider</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=modifierObservation">Modifier</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=supprimerObservation">Supprimer</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=filtre">Rechercher</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Membre
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=ajouterMembre">Ajouter</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=listeMembre">Modifier</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=supprimerMembre">Supprimer</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Lieu
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=ajouterLieu">Ajouter</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=listeLieu">Modifier</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=supprimerLieu">Supprimer</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Groupe
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=ajouterGroupe">Ajouter</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=listeGroupe">Modifier</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=supprimerGroupe">Supprimer</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Dominante
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=ajouterDominante">Ajouter</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=listeDominante">Modifier</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=supprimerDominante">Supprimer</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Dominante
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=ajouterDominante">Ajouter</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=listeDominante">Modifier</a>
                    <a class="dropdown-item" href="index.php?uc=<?=$_SESSION['poste']?>&action=supprimerDominante">Supprimer</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?uc=connexion&action=deconnexion">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>