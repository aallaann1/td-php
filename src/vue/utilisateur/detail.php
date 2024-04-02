<h1>Détails de la voiture</h1>
<?php

/** @var TYPE_NAME $utilisateur */
echo "Login : " . htmlspecialchars($utilisateur->getLogin()) . "<br>";
echo "Nom : " . htmlspecialchars($utilisateur->getNom()) . "<br>";
echo "Prenom : " . htmlspecialchars($utilisateur->getPrenom()) . "<br>";

require 'liste.php';

?>