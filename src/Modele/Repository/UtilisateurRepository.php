<?php

namespace App\Covoiturage\Modele\Repository;

use App\Covoiturage\Modele\DataObject\Utilisateur;
use PDO;
use PDOException;

class UtilisateurRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return 'utilisateur';
    }


    /**
     * @param array $utilisateurTableau
     * @return Utilisateur
     */
    protected function construireDepuisTableau(array $ligne): Utilisateur
    {
        return new Utilisateur(
            $ligne['login'],
            $ligne['nom'],
            $ligne['prenom'],
            $ligne['mdpHache']
        );
    }

    protected function getNomsColonnes(): array
    {
        return ['login', 'nom', 'prenom', 'mdpHache'];
    }

    protected function getNomClePrimaire(): string
    {
        return 'login';
    }

}












/*public static function sauvegarder(Utilisateur $utilisateur): void
    {
        $sql = "INSERT INTO utilisateur (login, nom, prenom)
            VALUES (:login, :nom, :prenom)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "login" => $utilisateur->getLogin(),
            "nom" => $utilisateur->getNom(),
            "prenom" => $utilisateur->getPrenom(),
        );

        try {
            $pdoStatement->execute($values);
        } catch (PDOException $e) {
            die("Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage());
        }
    }*/

/*public static function mettreAJour(Utilisateur $utilisateur)
{
    $sql = "UPDATE utilisateur SET nom = :nom, prenom = :prenom WHERE login = :login";

    $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

    $values = array(
        "login" => $utilisateur->getLogin(),
        "nom" => $utilisateur->getNom(),
        "prenom" => $utilisateur->getPrenom(),
    );

    try {
        $pdoStatement->execute($values);
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage());
    }
}*/

/* public static function getUtilisateurs(): array
    {
        $utilisateurs = [];

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->query("SELECT * FROM utilisateur");

        foreach ($pdoStatement as $utilisateurFormatTableau) {
            $utilisateur = UtilisateurRepository::construireDepuisTableau($utilisateurFormatTableau);
            $utilisateurs[] = $utilisateur;
        }

        return $utilisateurs;
    } */