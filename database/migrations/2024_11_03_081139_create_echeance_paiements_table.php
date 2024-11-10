<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcheancePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echeance_paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id');
            $table->string('nom_echeance');
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('amount');
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
        Schema::dropIfExists('echeance_paiements');
    }
}
