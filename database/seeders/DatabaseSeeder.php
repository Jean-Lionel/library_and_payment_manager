<?php

namespace Database\Seeders;


use App\Models\Eleve;
use App\Models\Trimestre;
use Database\Seeders\AnneScolaireSeeder;
use Database\Seeders\RoleSeeder;
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
       \App\Models\User::factory(1)->create();
        // \App\Models\Section::factory(10)->create();
        // \App\Models\Classe::factory(20)->create();
        // \App\Models\Eleve::factory(120)->create();
        // \App\Models\Stock::factory(2)->create();
        // \App\Models\Category::factory(5)->create();
        // \App\Models\Product::factory(120)->create();

       Trimestre::create([
                'name' => 'PREMIERE TRIMESTRE'
            ]);
        Trimestre::create([
                'name' => 'DEUXIEME TRIMESTRE'
            ]);
        Trimestre::create([
                'name' => 'TROISIEME TRIMESTRE'
            ]);

        $this->call([
            //AnneScolaireSeeder::class,
            RoleSeeder::class
        ]);
    }
}
