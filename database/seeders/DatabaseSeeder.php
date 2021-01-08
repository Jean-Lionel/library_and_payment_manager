<?php

namespace Database\Seeders;


use App\Models\Eleve;
use Database\Seeders\AnneScolaireSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();
        \App\Models\Section::factory(10)->create();
        \App\Models\Classe::factory(20)->create();
        \App\Models\Eleve::factory(120)->create();
        \App\Models\Stock::factory(2)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(120)->create();

        $this->call([
            AnneScolaireSeeder::class
        ]);
    }
}
