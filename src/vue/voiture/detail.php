<h1>Détails de la voiture</h1>
<?php

/** @var TYPE_NAME $voiture */
    echo "Immatriculation : " . htmlspecialchars($voiture->getImmatriculation()) . "<br>";
    echo "Couleur : " . htmlspecialchars($voiture->getCouleur()) . "<br>";
    echo "Marque : " . htmlspecialchars($voiture->getMarque()) . "<br>";
    echo "Nombre de sièges : " . htmlspecialchars($voiture->getNbSieges()) . "<br>";

require 'liste.php';

?>

