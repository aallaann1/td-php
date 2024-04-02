<?php

namespace App\Covoiturage\Controleur;

use App\Covoiturage\Modele\DataObject\Voiture;
use App\Covoiturage\Modele\Repository\ConnexionBaseDeDonnee;
use App\Covoiturage\Modele\Repository\VoitureRepository;
use http\Encoding\Stream;


class ControleurVoiture extends ControleurGenerique
{
    public static function afficherListe()
    {
        $voitures = (new VoitureRepository())->recuperer();

        if (is_array($voitures)) {
            $parametresVue = [
                "voitures" => $voitures,
                "pagetitle" => "Liste des voitures",
                "cheminVueBody" => "voiture/liste.php"
            ];

            ControleurVoiture::afficherVue('vueGenerale.php', $parametresVue);
        } else {
            echo '<p>Aucune voiture trouvée.</p>';
        }
    }



    public static function afficherDetail()
    {
        $immatriculation = $_GET['immatriculation'] ?? '';

        $voiture = (new VoitureRepository())->recupererParClePrimaire($immatriculation);

        if ($voiture === null) {
            ControleurVoiture::afficherErreur("Aucune voiture correspondant à cette immatriculation n'a été trouvée.");
        } else {
            $parametresVue = [
                'voiture' => $voiture,
                "pagetitle" => "Détail de la voiture",
                "cheminVueBody" => "voiture/detail.php"
            ];
            ControleurVoiture::afficherVue('vueGenerale.php', $parametresVue);
        }
    }


    public static function afficherFormulaireCreation()
    {
        ControleurVoiture::afficherVue('voiture/formulaireCreation.php');
    }

    public static function creerDepuisFormulaire()
    {

        $immatriculation = $_GET['immatriculation'];
        $marque = $_GET['marque'];
        $couleur = $_GET['couleur'];
        $nbSieges = $_GET['place'];

        $nouvelleVoiture = new Voiture($immatriculation, $couleur, $marque, $nbSieges);

        $voiture = (new VoitureRepository())->sauvegarder($nouvelleVoiture);

        $voitures = (new VoitureRepository())->recuperer();

        if (is_array($voitures)) {
            $parametresVue = [
                "pagetitle" => "Liste des voitures",
                "cheminVueBody" => "voiture/voitureCreee.php",
                "voiture" => $voitures
            ];

            ControleurVoiture::afficherVue('vueGenerale.php', $parametresVue);
        } else {
            echo '<p>Aucune voiture trouvée.</p>';
        }
    }

    public static function afficherErreur(string $messageErreur = "")
    {
        $message = !empty($messageErreur) ? "Problème avec la voiture : $messageErreur" : "Problème avec la voiture";

        $parametresVue = [
            "pagetitle" => "Liste des voitures",
            "cheminVueBody" => "voiture/liste.php",
            ['message' => $message]
        ];

        ControleurVoiture::afficherVue('vueGenerale.php', $parametresVue);
    }

    public static function supprimer()
    {
        $immatriculation = $_GET['immatriculation'] ?? '';


        $voiture = (new VoitureRepository())->supprimer($immatriculation);

        $parametresVue = [
            'immatriculation' => $immatriculation,
            "pagetitle" => "Liste des voitures",
            "cheminVueBody" => "voiture/voitureSupprimee.php"
        ];

        ControleurVoiture::afficherVue('vueGenerale.php', $parametresVue);
    }

    public static function afficherFormulaireMiseAJour(){

        $immatriculation = $_GET['immatriculation'] ?? '';
        $voiture = (new VoitureRepository())->recupererParClePrimaire($immatriculation);

        ControleurVoiture::afficherVue('vueGenerale.php', ["pagetitle" => "formulaire de modification", "cheminVueBody" => "voiture/formulaireMiseAJour.php", "voiture" => $voiture]);
    }

    public static function mettreAJour()
    {
        $immatriculation = $_GET['immatriculation'] ?? '';
        $voiture = new Voiture($immatriculation, $_GET['marque'], $_GET['couleur'], $_GET['place']);

        $voiture = (new VoitureRepository())->mettreAJour($voiture);

        $voitures = (new VoitureRepository())->recuperer();


        $parametresVue = [
                "pagetitle" => "Mise à jour de la voiture",
                "cheminVueBody" => "voiture/voitureMiseAJour.php",
                "immatriculation" => $immatriculation,
                "voitures" => $voitures
            ];

        ControleurVoiture::afficherVue('vueGenerale.php', $parametresVue);
    }




}

?>