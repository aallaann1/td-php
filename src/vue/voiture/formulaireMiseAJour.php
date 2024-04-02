<h1>Formulaire de Mise à Jour de la Voiture</h1>
<form action="controleurFrontal.php" method="get">

    <label for="immatriculation">Immatriculation :</label>
    <input type="text" id="immatriculation" name="immatriculation" readonly value="<?php /** @var TYPE_NAME $voiture */
    echo htmlspecialchars($voiture->getImmatriculation()); ?>">
    </br>
    <label for="marque">Marque :</label>
    <input type="text" id="marque" name="marque" value="<?php echo htmlspecialchars($voiture->getMarque()); ?>">
    </br>
    <label for="couleur">Couleur :</label>
    <input type="text" id="couleur" name="couleur" value="<?php echo htmlspecialchars($voiture->getCouleur()); ?>">
    </br>
    <label for="nbSieges">Nombre de Sièges :</label>
    <input type="number" id="nbSieges" name="place" value="<?php echo htmlspecialchars($voiture->getNbSieges()); ?>">
    </br>
    <p>
        <input type="hidden" name="action" value="mettreAJour">
        <input type="hidden" name="controleur" value="voiture">
        <input type="submit" value="envoyer">
    </p>
</form>
