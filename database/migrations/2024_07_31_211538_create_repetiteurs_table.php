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
            $table->string('carte_identite_repetiteur');
            $table->string('photo_repetiteur');
            $table->foreignId('user_id');
            $table->foreignId('enseignant_id')->nullable();
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
