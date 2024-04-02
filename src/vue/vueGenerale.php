<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php /** @var string $pagetitle */
        echo $pagetitle; ?></title>
    <link rel="stylesheet" href="../ressources/css/style.css" type="text/css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li>
                <a href="controleurFrontal.php?action=afficherListe&controleur=voiture">Gestion des voitures</a>
            </li><li>
                <a href="controleurFrontal.php?action=afficherListe&controleur=utilisateur">Gestion des utilisateurs</a>
            </li><li>
                <a href="controleurFrontal.php?action=afficherListe&controleur=trajet">Gestion des trajets</a>
            </li>
            <li>
                <a href="controleurFrontal.php?action=afficherFormulairePreference">
                    <img src="../ressources/img/heart.png" alt="Coeur"></a>
            </li>

            <?php
            use App\Covoiturage\Lib\ConnexionUtilisateur;
            // Vérifier si aucun utilisateur n'est pas connecté
            if (!ConnexionUtilisateur::estConnecte()) {
                echo '<li><a href="controleurFrontal.php?action=afficherFormulaireCreation&controleur=utilisateur"><img src="../ressources/img/add-user.png" alt="Inscription"></a></li>';
                echo '<li><a href="controleurFrontal.php?action=afficherFormulaireConnexion&controleur=utilisateur"><img src="../ressources/img/enter.png" alt="Connexion"></a></li>';
            }

            // Vérifier si l'utilisateur est connecté
            if (ConnexionUtilisateur::estConnecte()) {
                $log = ConnexionUtilisateur::getLoginUtilisateurConnecte();
                echo '<li><a href="controleurFrontal.php?action=afficherDetail&controleur=utilisateur&login=' . urlencode($log) . '"><img src="../ressources/img/user.png" alt="Compte"></a></li>';
                echo '<li><a href="controleurFrontal.php?action=deconnecter&controleur=utilisateur"><img src="../ressources/img/logout.png" alt="Deconnexion"></a></li>';
            }
            ?>

        </ul>
    </nav>
</header>
<main>
    <?php
    /** @var string $cheminVueBody */
    require __DIR__ . "/{$cheminVueBody}";
    ?>
</main>
<footer>
    <p>
        Site de covoiturage de Alan TERRIER
    </p>
</footer>
</body>
</html>