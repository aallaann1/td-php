<?php

namespace App\Covoiturage\Modele\HTTP;

class Cookie
{
    public static function enregistrer(string $cle, mixed $valeur, ?int $dureeExpiration = null): void
    {
        $valeur = serialize($valeur);

        if ($dureeExpiration === null) {
            $expiration = 0;
        } else {
            $expiration = time() + $dureeExpiration;
        }

        setcookie($cle, $valeur, $expiration, '/');
    }

    public static function lire(string $cle): mixed
    {
        if (isset($_COOKIE[$cle])) {
            return unserialize($_COOKIE[$cle]);
        } else {
            return null;
        }
    }

    public static function contient($cle): bool
    {
        return array_key_exists($cle, $_COOKIE);
    }

    public static function supprimer($cle): void
    {
        setcookie($cle, '', 1);
    }


}
