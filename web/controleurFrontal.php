<?php

require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';

// initialisation
$loader = new App\Covoiturage\Lib\Psr4AutoloaderClass();
$loader->register();

$loader->addNamespace('App\Covoiturage', __DIR__ . '/../src');

use App\Covoiturage\Controleur\ControleurVoiture;
use App\Covoiturage\Lib\PreferenceControleur;



$controleurParDefaut = 'voiture';

if (PreferenceControleur::existe()) {
    $controleurParDefaut = PreferenceControleur::lire();
}

$controleur = isset($_GET['controleur']) ? $_GET['controleur'] : $controleurParDefaut;

$ControleurAffichage = 'App\Covoiturage\Controleur\Controleur' . ucfirst($controleur);


if (class_exists($ControleurAffichage)) {

    /** @var TYPE_NAME $ControleurAffichage */
    if (isset($_GET['action'])){
        $action = $_GET['action'];
        $test = get_class_methods($ControleurAffichage);
        if (in_array($action, $test)) {
            $ControleurAffichage::$action();
        } else {
            $ControleurAffichage::afficherErreur("Action non valide : $action");
        }
    }
    else {
        $ControleurAffichage::afficherErreur("Action non valide");
    }

} else {
    echo "Controleur $controleur non imlémenté";
}

?>
