<?php

namespace App\Covoiturage\Lib;

class ConnexionUtilisateur
{
    // L'utilisateur connecté sera enregistré en session associé à la clé suivante
    private static string $cleConnexion = "_utilisateurConnecte";

    public static function connecter(string $loginUtilisateur): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION[self::$cleConnexion] = $loginUtilisateur;
    }

    public static function estConnecte(): bool
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        return isset($_SESSION[self::$cleConnexion]);
    }

    public static function deconnecter(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION[self::$cleConnexion]);
    }

    public static function getLoginUtilisateurConnecte(): ?string
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        return isset($_SESSION[self::$cleConnexion]) ? $_SESSION[self::$cleConnexion] : null;
    }
}
