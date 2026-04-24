<?php

namespace Database\Factories;

use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utilisateur>
 */
class UtilisateurFactory extends Factory
{
    protected $model = Utilisateur::class; // <-- toujours préciser le modèle

    public function definition(): array
    {
        return [
            "code_user" => $this->faker->unique()->numerify('USER###'),
            "nom_user" => $this->faker->lastName(),
            "prenom_user" => $this->faker->firstName(),
            "login_user" => $this->faker->unique()->userName(),
            "password_user" => bcrypt("password"),
            "tel_user" => $this->faker->phoneNumber(),
            "sexe_user" => $this->faker->randomElement(["M","F"]),
            "role_user" => $this->faker->randomElement(["technicien","client"]),
            "etat_user" => $this->faker->randomElement(["actif","inactif","suspendu"]),
        ];
    }
}
