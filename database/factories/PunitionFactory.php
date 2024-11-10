<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Punition;

class PunitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Punition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_punition_id' => $this->faker->word,
            'description' => $this->faker->text,
            'date_punition' => $this->faker->date(),
            'statut' => $this->faker->word,
            'eleve_id' => $this->faker->word,
            'enseignant_id' => $this->faker->word,
            'user_id' => $this->faker->word,
        ];
    }
}
