<?php

namespace App\Covoiturage\Configuration;

class Configuration
{

    static private array $databaseConfiguration = array(
        // Le nom d'hote est webinfo a l'IUT
        // ou localhost sur votre machine
        //
        // ou webinfo.iutmontp.univ-montp2.fr
        // pour accéder à webinfo depuis l'extérieur
        'hostname' => 'webinfo',
        // A l'IUT, vous avez une BDD nommee comme votre login
        // Sur votre machine, vous devrez creer une BDD
        'database' => 'terriera',
        // À l'IUT, le port de MySQL est particulier : 3316
        // Ailleurs, on utilise le port par défaut : 3306
        'port' => '3316',
        // A l'IUT, c'est votre login
        // Sur votre machine, vous avez surement un compte 'root'
        'login' => 'terriera',
        // A l'IUT, c'est le même mdp que PhpMyAdmin
        // Sur votre machine personelle, vous avez creez ce mdp a l'installation
        'password' => 'apagnan'
    );

    static public function getLogin(): string
    {
        // L'attribut statique $databaseConfiguration
        // s'obtient avec la syntaxe Configuration::$databaseConfiguration
        // au lieu de $this->databaseConfiguration pour un attribut non statique
        return Configuration::$databaseConfiguration['login'];
    }

    static public function getHostname(): string
    {
        return Configuration::$databaseConfiguration['hostname'];
    }

    static public function getPort(): string
    {
        return Configuration::$databaseConfiguration['port'];
    }

    static public function getDatabase(): string
    {
        return Configuration::$databaseConfiguration['database'];
    }

    static public function getPassword(): string
    {
        return Configuration::$databaseConfiguration['password'];
    }

}

?>