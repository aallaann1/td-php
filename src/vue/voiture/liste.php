<?php

use App\Covoiturage\Modele\Repository\VoitureRepository;

$voitures = (new VoitureRepository())->recuperer();


if (is_array($voitures)) {
    echo '<h1>Liste des voitures</h1>';
    echo '<ul>';
    foreach ($voitures as $voiture) {

        $immatriculation = urldecode($voiture->getImmatriculation());

        echo '<li>';
        echo 'Voiture d\'immatriculation ';
        echo '<a href="controleurFrontal.php?action=afficherDetail&controleur=voiture&immatriculation=' . $immatriculation . '">';
        echo  htmlspecialchars($voiture->getImmatriculation());
        echo '</a>';
        echo '&nbsp;&nbsp;&nbsp;<a href="controleurFrontal.php?action=supprimer&controleur=voiture&immatriculation=' . $immatriculation . '">Supprimer</a>';
        echo '&nbsp;&nbsp;&nbsp;<a href="controleurFrontal.php?action=afficherFormulaireMiseAJour&controleur=voiture&immatriculation=' . $immatriculation . '">Mettre à jour</a>';
        echo '<br>';
        echo '</li>';
    }
    echo '</ul>';

    echo '<a href="controleurFrontal.php?action=afficherFormulaireCreation&controleur=voiture">Créer une voiture</a>';

} else {
    echo '<p>Aucune voiture trouvée.</p>';
}
?>
