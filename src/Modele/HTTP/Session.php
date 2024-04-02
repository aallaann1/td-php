<?php

namespace App\Covoiturage\Modele\HTTP;
use Exception;

class Session
{
    private static ?Session $instance = null;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        if (session_start() === false) {
            throw new Exception("La session n'a pas réussi à démarrer.");
        }
        $this->verifierDerniereActivite();
    }

    public static function getInstance(): Session
    {
        if (is_null(Session::$instance)) {
            Session::$instance = new Session();
        }
        return Session::$instance;
    }

    public function contient($nom): bool
    {
        return isset($_SESSION[$nom]);
    }

    public function enregistrer(string $nom, mixed $valeur): void
    {
        $_SESSION[$nom] = $valeur;
    }

    public function lire(string $nom): mixed
    {
        if ($this->contient($nom)) {
            return $_SESSION[$nom];
        }
        return null;
    }

    public function supprimer($nom): void
    {
        if ($this->contient($nom)) {
            unset($_SESSION[$nom]);
        }
    }

    public function detruire(): void
    {
        session_unset();
        session_destroy();
        Cookie::supprimer(session_name());
        $this->instance = null;
    }

    public function verifierDerniereActivite()
    {
        $dureeExpiration = 1800;

        if (isset($_SESSION['derniereActivite']) && (time() - $_SESSION['derniereActivite'] > $dureeExpiration)) {
            session_unset();
            session_destroy();
            Cookie::supprimer(session_name());
            $instance = null;
        }

        $_SESSION['derniereActivite'] = time();
    }

}