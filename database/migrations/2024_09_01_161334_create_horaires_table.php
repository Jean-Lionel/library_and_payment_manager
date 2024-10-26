<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horaires', function (Blueprint $table) {
            $table->id();
            $table->string('jour');
            $table->string('intervalle');
            $table->foreignId('classe_id');
            $table->string('cours');
            $table->foreignId('enseignant_id');
            $table->string('heure');
            $table->string('intervalle');
            $table->foreignId('user_id');
            $table->foreignId('ecole_id');
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
        Schema::dropIfExists('horaires');
    }
}
