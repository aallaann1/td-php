<?php

namespace App\Covoiturage\Controleur;

use App\Covoiturage\Modele\DataObject\Utilisateur;
use App\Covoiturage\Modele\DataObject\Voiture;
use App\Covoiturage\Modele\HTTP\Session;
use App\Covoiturage\Modele\Repository\UtilisateurRepository;
use App\Covoiturage\Modele\Repository\VoitureRepository;
use App\Covoiturage\Modele\HTTP\Cookie;
use App\Covoiturage\Lib\MotDePasse;
use App\Covoiturage\Lib\ConnexionUtilisateur;

class ControleurUtilisateur extends ControleurGenerique
{
    public static function afficherListe()
    {
        $utilisateur = (new UtilisateurRepository())->recuperer();

        if (is_array($utilisateur)) {
            $parametresVue = [
                "utilisateurs" => $utilisateur,
                "pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "utilisateur/liste.php"
            ];

            ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresVue);
        } else {
            echo '<p>Aucune utilisateur trouvée.</p>';
        }
    }

    public static function afficherErreur(string $messageErreur = '')
    {

        $parametresVue = [
            "pagetitle" => "Liste des utilisateurs",
            "cheminVueBody" => "utilisateur/erreur.php",
            "message" => $messageErreur
        ];

        ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresVue);
    }

    public static function afficherDetail()
    {
        $login = $_GET['login'] ?? '';

        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);

        if ($login === null) {
            ControleurVoiture::afficherErreur("Aucun utilisateur correspondant à ce login n'a été trouvée.");
        } else {
            $parametresVue = [
                'utilisateur' => $utilisateur,
                "pagetitle" => "Détail de l'utilisateur",
                "cheminVueBody" => "utilisateur/detail.php"
            ];
            ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresVue);
        }
    }

    public static function supprimer()
    {
        $login = $_GET['login'] ?? '';


        $utilisateur = (new UtilisateurRepository())->supprimer($login);

        $parametresVue = [
            'login' => $login,
            "pagetitle" => "Liste des utilisateurs",
            "cheminVueBody" => "utilisateur/utilisateurSupprimee.php"
        ];

        ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresVue);
    }

    public static function afficherFormulaireCreation()
    {
        $parametresvues = [
            "pagetitle" => "Formulaire de création",
            "cheminVueBody" => "utilisateur/formulaireCreation.php"
        ];
        ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresvues);
    }


    public static function creerDepuisFormulaire()
    {
        $donneesFormulaire = [
            'login' => $_GET['login'] ?? '',
            'nom' => $_GET['nom'] ?? '',
            'prenom' => $_GET['prenom'] ?? '',
            'mdp' => $_GET['mdp'] ?? '',
        ];

        if ($donneesFormulaire['mdp'] !== $_GET['mdp2']) {
            ControleurUtilisateur::afficherErreur("Erreur : les deux mots de passe ne correspondent pas.");
        } else {

            $nouvelUtilisateur = Utilisateur::construireDepuisFormulaire($donneesFormulaire);

            $utilisateur = (new UtilisateurRepository())->sauvegarder($nouvelUtilisateur);

            $utilisateurs = (new UtilisateurRepository())->recuperer();

            if (is_array($utilisateurs)) {
                $parametresVue = [
                    "pagetitle" => "Liste des utilisateurs",
                    "cheminVueBody" => "utilisateur/utilisateurCreee.php",
                    "utilisateur" => $utilisateurs,
                    "login" => $nouvelUtilisateur->getLogin()
                ];

                self::afficherVue('vueGenerale.php', $parametresVue);
            } else {
                echo '<p>Aucun utilisateur trouvé.</p>';
            }
        }
    }


    public static function afficherFormulaireMiseAJour(){

        $login = $_GET['login'] ?? '';

        $utilisateur = (new UtilisateurRepository())->recupererParClePrimaire($login);

        ControleurUtilisateur::afficherVue('vueGenerale.php', ["pagetitle" => "formulaire de modification", "cheminVueBody" => "utilisateur/formulaireMiseAJour.php", "utilisateur" => $utilisateur]);
    }

    public static function mettreAJour()
    {
        $login = $_GET['login'] ?? '';
        $nom = $_GET['nom'] ?? '';
        $prenom = $_GET['prenom'] ?? '';
        $nouveauUtilisateur = new Utilisateur($login, $nom, $prenom, '');

        $ancienMotDePasse = $_GET['ancien_mdp'];
        $nouveauMotDePasse = $_GET['nouveau_mdp'];
        $confirmerMotDePasse = $_GET['confirmer_mdp'];


        if ($nouveauMotDePasse !== $confirmerMotDePasse) {
            ControleurUtilisateur::afficherErreur("Erreur : les deux nouveaux mots de passe ne correspondent pas.");
        }
        else {

            $utilisateurRepository = new UtilisateurRepository();
            $utilisateurExistant = $utilisateurRepository->recupererParClePrimaire($login);

            if (MotDePasse::verifier($ancienMotDePasse, $utilisateurExistant->getMdpHache())) {
                $nouveauUtilisateur->setMdpHache(MotDePasse::hacher($nouveauMotDePasse));

                $utilisateurRepository->mettreAJour($nouveauUtilisateur);

                $utilisateurs = (new UtilisateurRepository())->recuperer();

                $parametresVue = [
                    "pagetitle" => "Mise à jour de l'utilisateur",
                    "cheminVueBody" => "utilisateur/utilisateurMiseAJour.php",
                    "login" => $login,
                    "utilisateurs" => $utilisateurs
                ];

                ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresVue);
            } else {
                ControleurUtilisateur::afficherErreur("Ancien mot de passe erroné");
            }
        }
    }

    public static function afficherFormulaireConnexion()
    {
        $parametresVue = [
            "pagetitle" => "Formulaire de connexion",
            "cheminVueBody" => "utilisateur/formulaireConnexion.php"
        ];

        ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresVue);
    }

    public static function connecter()
    {
        $login = $_GET['login'] ?? '';
        $motDePasse = $_GET['mdp'] ?? '';

        if (empty($login) || empty($motDePasse)) {
            ControleurUtilisateur::afficherErreur("Login et/ou mot de passe manquant.");
        }
        else {
            $utilisateurRepository = new UtilisateurRepository();
            $utilisateur = $utilisateurRepository->recupererParClePrimaire($login);

            if ($utilisateur && MotDePasse::verifier($motDePasse, $utilisateur->getMdpHache())) {
                ConnexionUtilisateur::connecter($login);

                $parametresVue = [
                    "pagetitle" => "Utilisateur Connecté",
                    "cheminVueBody" => "utilisateur/utilisateurConnecte.php",
                    "utilisateur" => $utilisateur,
                    "login" => $login
                ];
                ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresVue);
            } else {
                ControleurUtilisateur::afficherErreur("Login inconnu ou mot de passe incorrect.");
            }
        }
    }

    public static function deconnecter()
    {
        $login = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        ConnexionUtilisateur::deconnecter();

        $parametresVue = [
            "pagetitle" => "Utilisateur Déconnecté",
            "cheminVueBody" => "utilisateur/utilisateurDeconnecte.php",
            "login" => $login
        ];
        ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresVue);
    }



}






























/*public static function deposerCookie()
    {
        $valeur = [1, 2, 3];
        Cookie::enregistrer('mon_cookie', $valeur, 3600);

        echo "Le cookie a été déposé avec succès !";

        $parametresVue = [
            "pagetitle" => "Mise à jour de l\'utilisateur",
            "cheminVueBody" => "utilisateur/liste.php"
        ];

        ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresVue);
    }

    public static function lireCookie(){
        $valeur = Cookie::lire('mon_cookie');

        if ($valeur !== null) {
            echo 'Valeur du cookie : ';
            print_r($valeur);
        } else {
            echo 'Aucun cookie trouvé.';
        }

        $parametresVue = [
            "pagetitle" => "Mise à jour de l\'utilisateur",
            "cheminVueBody" => "utilisateur/liste.php"
        ];

        ControleurUtilisateur::afficherVue('vueGenerale.php', $parametresVue);

    }*/