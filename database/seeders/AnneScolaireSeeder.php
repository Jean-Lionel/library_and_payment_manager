<?php

namespace Database\Seeders;

use App\Models\AnneScolaire;
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
    }
}
