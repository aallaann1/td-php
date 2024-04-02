<?php

namespace App\Covoiturage\Controleur;

class ControleurTrajet extends ControleurGenerique
{
    public static function afficherErreur(string $messageErreur = "")
    {
        $message = !empty($messageErreur) ? "Problème avec l'utilisateur : $messageErreur" : "Problème avec l'utilisateur";

        $parametresVue = [
            "pagetitle" => "Liste des utilisateurs",
            "cheminVueBody" => "trajet/nonImplemente.php",
            ['message' => $message]
        ];

        ControleurTrajet::afficherVue('vueGenerale.php', $parametresVue);
    }


}