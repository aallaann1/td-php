<?php

namespace App\Covoiturage\Modele\DataObject;
use App\Covoiturage\Lib\MotDePasse;

class Utilisateur extends AbstractDataObject
{
    private string $login;
    private string $nom;
    private string $prenom;
    private string $mdpHache;

    public function __construct(string $login, string $nom, string $prenom, string $mdpHache)
    {
        $this->login = $login;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mdpHache = $mdpHache;
    }

    public static function construireDepuisTableau(array $utilisateurTableau) : Utilisateur {
        return new Utilisateur(
            $utilisateurTableau["login"],
            $utilisateurTableau["nom"],
            $utilisateurTableau["prenom"],
            $utilisateurTableau["mdpHache"]
        );
    }

    public static function construireDepuisFormulaire(array $donneesFormulaire): Utilisateur
    {
        $login = $donneesFormulaire['login'] ?? '';
        $nom = $donneesFormulaire['nom'] ?? '';
        $prenom = $donneesFormulaire['prenom'] ?? '';
        $mdp = $donneesFormulaire['mdp'] ?? '';


        $mdpHache = MotDePasse::hacher($mdp);

        return new Utilisateur($login, $nom, $prenom, $mdpHache);
    }


    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function __toString() : string {
        return "<p> Utilisateur {$this->prenom} {$this->nom} de login {$this->login} </p>";
    }

    /**
     * @return Utilisateur[]
     */
    public static function getUtilisateurs() : array {
        $pdoStatement = Model::getPdo()->query("SELECT * FROM utilisateur");

        $utilisateurs = [];
        foreach($pdoStatement as $utilisateurFormatTableau) {
            $utilisateurs[] = Utilisateur::construireDepuisTableau($utilisateurFormatTableau);
        }

        return $utilisateurs;
    }

    public function getMdpHache(): string
    {
        return $this->mdpHache;
    }

    public function setMdpHache(string $mdpHache): void
    {
        $this->mdpHache = $mdpHache;
    }

    public function formatTalbeau(): array
    {
        return [
            'login' => $this->getLogin(),
            'nom' => $this->getNom(),
            'prenom' => $this->getPrenom(),
            'mdpHache' => $this->getMdpHache()
        ];
    }
}