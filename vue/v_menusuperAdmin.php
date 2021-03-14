<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav justify-content-around" id="menu">
            <li class="nav-item">
                <a class="nav-link" href="index.php?uc=profil&action=consulter">Profil</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Observations</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?uc=gestion&action=validerObservation">En attente de validation</a>
                    <a class="dropdown-item" href="index.php?uc=observation&action=rechercheObservations">Rechercher</a>
                    <a class="dropdown-item" href="index.php?uc=observation&action=ajouter">Ajouter</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?uc=gestion&action=listeMembre">Membre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?uc=gestion&action=listeLieu">Lieu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?uc=gestion&action=listeGroupe">Groupe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?uc=gestion&action=listeDominante">Dominante</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?uc=gestion&action=configurerServeur">Serveur</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?uc=connexion&action=deconnexion">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>