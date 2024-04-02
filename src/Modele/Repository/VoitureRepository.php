<?php

namespace App\Covoiturage\Modele\Repository;

use App\Covoiturage\Modele\DataObject\Voiture;
use PDO;
use PDOException;


class VoitureRepository extends AbstractRepository
{
    protected function getNomTable(): string
    {
        return 'voiture';
    }


    /**
     * @param array $voitureFormatTableau
     * @return Voiture
     */
    protected function construireDepuisTableau(array $voitureFormatTableau): Voiture
    {
        $immatriculation = $voitureFormatTableau['immatriculation'];
        $couleur = $voitureFormatTableau['couleur'];
        $marque = $voitureFormatTableau['marque'];
        $nbSieges = $voitureFormatTableau['nbSieges'];

        return new Voiture($immatriculation, $couleur, $marque, $nbSieges);
    }

    protected function getNomClePrimaire(): string
    {
        return 'immatriculation';
    }


    public function getNomsColonnes(): array
    {
        return [
            "immatriculation",
            "marque",
            "couleur",
            "nbSieges",
        ];
    }

}










/*public static function mettreAJour(Voiture $voiture)
{
    $sql = "UPDATE voiture SET couleur = :couleur, marque = :marque, nbSieges = :nbSieges WHERE immatriculation = :immatriculation";

    $array = [
        "immatriculation" => $voiture->getImmatriculation(),
        "couleur" => $voiture->getCouleur(),
        "marque" => $voiture->getMarque(),
        "nbSieges" => $voiture->getNbSieges(),
    ];

    $pdo = ConnexionBaseDeDonnee::getPdo();

    $pdoStatement = $pdo->prepare($sql);

    $pdoStatement->execute($array);
}*/

/*public static function sauvegarder(Voiture $voiture): void
    {
        $sql = "INSERT INTO voiture (immatriculation, couleur, marque, nbSieges)
            VALUES (:immatriculation, :couleur, :marque, :nbSieges)";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "immatriculation" => $voiture->getImmatriculation(),
            "couleur" => $voiture->getCouleur(),
            "marque" => $voiture->getMarque(),
            "nbSieges" => $voiture->getNbSieges(),
        );

        try {
            $pdoStatement->execute($values);
        } catch (PDOException $e) {
            die("Erreur lors de l'insertion de la voiture : " . $e->getMessage());
        }
    }*/

/*public static function getVoitureParImmatriculation(string $immatriculation): ?Voiture
    {
        $sql = "SELECT * from voiture WHERE immatriculationBDD = :immatriculationTag";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "immatriculationTag" => $immatriculation,
        );

        $pdoStatement->execute($values);
        $voitureFormatTableau = $pdoStatement->fetch();

        if ($voitureFormatTableau === false) return null;

        return (new VoitureRepository)->construireDepuisTableau($voitureFormatTableau);
    }*/


/* public static function supprimerParImmatriculation(string $immatriculation)
    {
        try {
            $pdo = ConnexionBaseDeDonnee::getPdo();
            $sql = "DELETE FROM voiture WHERE immatriculationBDD = :immatriculation";
            $pdoStatement = $pdo->prepare($sql);
            $values = [
                'immatriculation' => $immatriculation
            ];

            $pdoStatement->execute($values);
        } catch (PDOException $e) {
            // Gérez les erreurs de suppression ici
            die("Erreur lors de la suppression de la voiture : " . $e->getMessage());
        }
    } */


/*

public static function getVoitures(): array
    {
        $voitures = [];

        try {
            $pdo = ConnexionBaseDeDonnee::getPdo();
            $sql = "SELECT * FROM voiture";
            $pdoStatement = $pdo->query($sql);

            if ($pdoStatement === false) {
                die("Erreur d'exécution de la requête.");
            }

            foreach ($pdoStatement as $voitureFormatTableau) {
                $voiture = VoitureRepository::construireDepuisTableau($voitureFormatTableau);
                $voitures[] = $voiture;
            }

        } catch (PDOException $e) {
            die("Erreur lors de l'exécution de la requête : " . $e->getMessage());
        }

        return $voitures;
    }

 */
