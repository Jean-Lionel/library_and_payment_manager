<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecoles', function (Blueprint $table) {
            $table->id();
            $table->string('nom_ecole');
            $table->string('adresse_ecole');
            $table->string('arreter_ministeriel');
            $table->string('type_ecole');
            $table->string('categorie_ecole');
            $table->string('niveau_ecole');
            $table->string('vacation');
            $table->string('date_creation');
            $table->foreignId('province_id');
            $table->foreignId('territoire_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecoles');
    }
}
