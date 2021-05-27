<?php

namespace Database\Seeders;

use App\Models\AnneScolaire;
use App\Models\Trimestre;
use Illuminate\Database\Seeder;

class AnneScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        AnneScolaire::create(['name' => '2020-2021']);
        AnneScolaire::create(['name' => '2021-2022']);
        Trimestre::create(['name' => 'PREMIERE TRIMESTRE']);
        Trimestre::create(['name' => 'DEUXIEME TRIMESTRE']);
        Trimestre::create(['name' => 'TROISIEME TRIMESTRE']);
    }
}
