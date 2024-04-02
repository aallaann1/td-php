<h1>Erreur avec l'utilisateur</h1>

<?php

$messageErreur = $message ?? '';

if (!empty($messageErreur)) {
    echo '<p>' . htmlspecialchars($messageErreur) . '</p>';
} else {
    echo "<p>Une erreur inconnue est survenue avec l'utilisateur.</p>";
}
require 'liste.php';
?>

