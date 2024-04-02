<?php
use App\Covoiturage\Lib\PreferenceControleur;
?>

<h1>Formulaire de Préférence</h1>
<form method="get" action="controleurFrontal.php">
    <p>Choisissez le contrôleur par défaut :</p>

    <input type="radio" id="voitureId" name="controleur_defaut" value="voiture" <?php echo (PreferenceControleur::existe() && PreferenceControleur::lire() === 'voiture') ? 'checked' : ''; ?>>
    <label for="voitureId">Voiture</label>

    <input type="radio" id="utilisateurId" name="controleur_defaut" value="utilisateur" <?php echo (PreferenceControleur::existe() && PreferenceControleur::lire() === 'utilisateur') ? 'checked' : ''; ?>>
    <label for="utilisateurId">Utilisateur</label>

    <input type="radio" id="trajetId" name="controleur_defaut" value="trajet" <?php echo (PreferenceControleur::existe() && PreferenceControleur::lire() === 'trajet') ? 'checked' : ''; ?>>
    <label for="trajetId">Trajet</label>


    <input type="hidden" name="action" value="enregistrerPreference">
    <input type="submit" value="Enregistrer">
</form>