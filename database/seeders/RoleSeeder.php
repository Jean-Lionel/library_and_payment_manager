<?php
 
namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Role::create([
        'name' => 'ADMINSTRATEUR'
       ]); 
       Role::create([
        'name' => 'PREFETS DES ETUDES'
       ]);
       Role::create([
        'name' => 'PROFESSEUR'
       ]);
       Role::create([
        'name' => 'BIBLIOTHEQUAIRE'
       ]);
       Role::create([
        'name' => 'PARENT'
       ]);
       Role::create([
        'name' => 'DIRECTEUR'
       ]);
       Role::create([
        'name' => 'COMPTABLE'
       ]);
           Role::create([
        'name' => 'SECRETAIRE'
       ]);
       Role::create([
        'name' => 'GERANT QUANTINE'
       ]);
       
    }
}
