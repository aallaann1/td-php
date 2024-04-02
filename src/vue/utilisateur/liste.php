<?php

use App\Covoiturage\Modele\Repository\UtilisateurRepository;

$utilisateurs = (new UtilisateurRepository())->recuperer();

/** @var TYPE_NAME $utilisateurs */
if (is_array($utilisateurs)) {

    echo '<h1>Liste des utilisateurs</h1>';
    echo '<ul>';

    foreach ($utilisateurs as $utilisateur) {

        $login = urldecode($utilisateur->getLogin());

        echo '<li>';
        echo 'Utilisateur de login ';
        echo '<a href="controleurFrontal.php?action=afficherDetail&controleur=utilisateur&login=' . $login . '">';
        echo  htmlspecialchars($utilisateur->getLogin());
        echo '</a>';
        echo '&nbsp;&nbsp;&nbsp;<a href="controleurFrontal.php?action=supprimer&controleur=utilisateur&login=' . $login . '">Supprimer</a>';
        echo '&nbsp;&nbsp;&nbsp;<a href="controleurFrontal.php?action=afficherFormulaireMiseAJour&controleur=utilisateur&login=' . $login . '">Mettre à jour</a>';
        echo '<br>';
        echo '</li>';
    }

    echo '</ul>';

    echo '<a href="controleurFrontal.php?action=afficherFormulaireCreation&controleur=utilisateur">Créer un utilisateur</a>';

} else {

    echo '<p>Aucun utilisateur trouvé.</p>';
}
?>
