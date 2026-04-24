<?php

namespace App\Helpers;

use App\Models\Utilisateur;

class MatriculeHelper
{
    /**
     * Génère un matricule unique pour un utilisateur
     * Format: USR + année + mois + jour + numéro aléatoire
     */
    public static function genererMatricule(): string
    {
        do {
            // Format: USR-2025-001234
            $prefix = 'USR';
            $date = date('Ymd');
            $random = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
            $matricule = $prefix . '-' . $date . '-' . $random;

            // Vérifier si le matricule existe déjà
            $existe = Utilisateur::where('code_user', $matricule)->exists();
        } while ($existe);

        return $matricule;
    }

    /**
     * Génère un matricule avec un préfixe personnalisé
     */
    public static function genererMatriculeAvecPrefixe($prefixe): string
    {
        do {
            $date = date('Ymd');
            $random = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
            $matricule = $prefixe . '-' . $date . '-' . $random;

            $existe = Utilisateur::where('code_user', $matricule)->exists();
        } while ($existe);

        return $matricule;
    }
}
