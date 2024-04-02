<?php

namespace App\Covoiturage\Controleur;

use App\Covoiturage\Lib\PreferenceControleur;

class ControleurGenerique
{

    protected static function afficherVue(string $cheminVue, array $parametres = []): void
    {
        extract($parametres);
        require __DIR__ . "/../vue/$cheminVue";
    }

    public static function afficherFormulairePreference()
    {
        $parametresVue = [
            "pagetitle" => "Formulaire de Préférence",
            "cheminVueBody" => "formulairePreference.php"
        ];

        ControleurGenerique::afficherVue('vueGenerale.php', $parametresVue);
    }

    public static function enregistrerPreference()
    {
        if (isset($_GET['controleur_defaut'])) {
            $preference = $_GET['controleur_defaut'];
            PreferenceControleur::enregistrer($preference);
            $parametresVue = [
                "message" => "La préférence de contrôleur est enregistrée !",
                "cheminVueBody" => "preferenceEnregistree.php"
            ];
            ControleurGenerique::afficherVue('vueGenerale.php', $parametresVue);
        } else {
            $parametresVue = [
                "message" => "La préférence de contrôleur n'a pas été enregistrée !",
                "cheminVueBody" => "preferenceEnregistree.php"
            ];
            ControleurGenerique::afficherVue('vueGenerale.php', $parametresVue);
        }
    }



}