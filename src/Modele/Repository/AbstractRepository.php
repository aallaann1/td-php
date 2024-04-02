<?php

namespace App\Covoiturage\Modele\Repository;

use App\Covoiturage\Modele\DataObject\AbstractDataObject;
use PDO;
use PDOException;

abstract class AbstractRepository
{

    /**
     * @return AbstractDataObject[]
     */
    public function recuperer(): array
    {
        $items = [];

            $pdo = ConnexionBaseDeDonnee::getPdo();
            $table = $this->getNomTable();
            $sql = "SELECT * FROM $table";
            $pdoStatement = $pdo->query($sql);

            foreach ($pdoStatement as $itemFormatTableau) {
                $item = $this->construireDepuisTableau($itemFormatTableau);
                $items[] = $item;
            }

        return $items;
    }

    public function recupererParClePrimaire(string $valeurClePrimaire): ?AbstractDataObject
    {
        $pdo = ConnexionBaseDeDonnee::getPdo();
        $table = $this->getNomTable();
        $clePrimaire = $this->getNomClePrimaire();

        $sql = "SELECT * FROM $table WHERE $clePrimaire = :clePrimaire";
        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        $values = array(
            "clePrimaire" => $valeurClePrimaire,
        );


        $pdoStatement->execute($values);
        $objetFormatTableau = $pdoStatement->fetch();

        if ($objetFormatTableau === false) return null;

        return $this->construireDepuisTableau($objetFormatTableau);
    }


    /**
     * @param string $valeurClePrimaire
     * @return void
     */
    public function supprimer(string $valeurClePrimaire)
    {
        try {
            $pdo = ConnexionBaseDeDonnee::getPdo();
            $table = $this->getNomTable();
            $clePrimaire = $this->getNomClePrimaire();

            $sql = "DELETE FROM $table WHERE $clePrimaire = :clePrimaire";
            $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

            $values = array(
                "clePrimaire" => $valeurClePrimaire,
            );

            $pdoStatement->execute($values);
        } catch (PDOException $e) {
            // Gérez les erreurs de suppression ici
            die("Erreur lors de la suppression de la voiture : " . $e->getMessage());
        }
    }

    public function mettreAJour(AbstractDataObject $objet): AbstractDataObject
    {
        $pdo = ConnexionBaseDeDonnee::getPdo();
        $table = $this->getNomTable();
        $clePrimaire = $this->getNomClePrimaire();
        $colonnes = $this->getNomsColonnes();
        $values = $objet->formatTalbeau();

        $sql = "UPDATE $table SET ";
        foreach ($colonnes as $colonne) {
            $sql .= "$colonne = :$colonne, ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE $clePrimaire = :$clePrimaire";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        try {
            $pdoStatement->execute($values);
        } catch (PDOException $e) {
            die("Erreur lors de la mise à jour de l'objet : " . $e->getMessage());
        }

        return $objet;
    }

    public function sauvegarder(AbstractDataObject $objet): AbstractDataObject
    {
        $pdo = ConnexionBaseDeDonnee::getPdo();
        $table = $this->getNomTable();
        $colonnes = $this->getNomsColonnes();
        $values = $objet->formatTalbeau();

        $sql = "INSERT INTO $table (";
        foreach ($colonnes as $colonne) {
            $sql .= "$colonne, ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ") VALUES (";
        foreach ($colonnes as $colonne) {
            $sql .= ":$colonne, ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ")";

        $pdoStatement = ConnexionBaseDeDonnee::getPdo()->prepare($sql);

        try {
            $pdoStatement->execute($values);
        } catch (PDOException $e) {
            die("Erreur lors de l'insertion de l'objet : " . $e->getMessage());
        }

        return $objet;
    }



    protected abstract function getNomTable(): string;

    protected abstract function construireDepuisTableau(array $objetFormatTableau) : AbstractDataObject;

    protected abstract function getNomClePrimaire(): string;

    protected abstract function getNomsColonnes(): array;

}