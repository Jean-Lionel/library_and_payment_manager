<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepetiteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repetiteurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_repetiteur');
            $table->string('prenom_repetiteur');
            $table->string('postnom_repetiteur');
            $table->string('carte_identite_repetiteur');
            $table->string('email_repetiteur');
            $table->string('photo_repetiteur')->nullable();
            $table->string('sexe_repetiteur');
            $table->string('date_naissance_repetiteur');
            $table->text('description_repetiteur');
            $table->string('telephone_repetiteur');
            $table->string('territoire');
            $table->string('quartier');
            $table->string('avenue');
            $table->string('cours')->nullable();
            $table->integer('experience');
            $table->foreignId('user_id');
            $table->foreignId('ecole_id')->nullable();
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
        Schema::dropIfExists('repetiteurs');
    }
}
