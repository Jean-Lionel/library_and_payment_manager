<?php

namespace Database\Factories;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => 'Jean Lionel',
            'user_name' => 'jean',
            'email' => 'nijeanlionel@gmail.com',
            'telephone' => '+257 79 614 036',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // 12345678
            'remember_token' => Str::random(10),
        ];
    }
}
