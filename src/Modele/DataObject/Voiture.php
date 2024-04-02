<?php

namespace App\Covoiturage\Modele\DataObject;


class Voiture extends AbstractDataObject
{

    private $immatriculation;
    private $couleur;
    private $marque;
    private $nbSieges;

    public function __construct($immatriculation, $couleur, $marque, $nbSieges)
    {
        $this->immatriculation = $immatriculation;
        $this->couleur = $couleur;
        $this->marque = $marque;
        $this->nbSieges = $nbSieges;
    }

    public function getImmatriculation(): string
    {
        return $this->immatriculation;
    }

    public function afficher()
    {
        echo "Immatriculation : " . $this->immatriculation . "<br>";
        echo "Couleur : " . $this->couleur . "<br>";
        echo "Marque : " . $this->marque . "<br>";
        echo "Nombre de sièges : " . $this->nbSieges . "<br>";
    }

    public function getCouleur(): string
    {
        return $this->couleur;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function getNbSieges()
    {
        return $this->nbSieges;
    }

    public function setImmatriculation($immatriculation)
    {
        $this->immatriculation = $immatriculation;
    }

    public function formatTalbeau(): array
    {
        return array(
            "immatriculation" => $this->immatriculation,
            "marque" => $this->couleur,
            "couleur" => $this->marque,
            "nbSieges" => $this->nbSieges
        );
    }
}

?>