<?php

namespace App\Covoiturage\Modele\Repository;

use PDO;
use App\Covoiturage\Configuration\Configuration;

class ConnexionBaseDeDonnee
{

    private PDO $pdo;
    private static ?ConnexionBaseDeDonnee $instance = null;

    public function __construct()
    {
        // Récupérez les informations de configuration de la base de données depuis Configuration.php
        $hostname = Configuration::getHostname();
        $port = Configuration::getPort();
        $databaseName = Configuration::getDatabase();
        $login = Configuration::getLogin();
        $password = Configuration::getPassword();

        try {
            // Initialisez la connexion PDO à la base de données
            $this->pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$databaseName", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));            // Configurez PDO pour générer des exceptions en cas d'erreurs SQL
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getPdo(): PDO
    {
        return ConnexionBaseDeDonnee::getInstance()->pdo;
    }

    private static function getInstance(): ConnexionBaseDeDonnee
    {
        // L'attribut statique $pdo s'obtient avec la syntaxe ConnexionBaseDeDonnee::$pdo
        // au lieu de $this->pdo pour un attribut non statique
        if (is_null(ConnexionBaseDeDonnee::$instance)) {
            // Appel du constructeur
            ConnexionBaseDeDonnee::$instance = new ConnexionBaseDeDonnee();
        }
        return ConnexionBaseDeDonnee::$instance;
    }
}

