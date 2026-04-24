<?php

namespace Database\Factories;

use App\Models\Competence;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetenceFactory extends Factory
{
    protected $model = Competence::class;

    public function definition(): array
    {
        return [
            'label_comp' => $this->faker->word(),
            'description_comp' => $this->faker->sentence(),
        ];
    }
}
