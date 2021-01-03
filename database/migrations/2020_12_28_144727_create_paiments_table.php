<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiments', function (Blueprint $table) {
            $table->id();
            $table->double('amount',60,2);
            $table->string('bordereau');
            $table->string('type_paiement');
            $table->foreignId('compte_id');
            $table->string('compte_name');
            $table->foreignId('eleve_id');
            $table->foreignId('user_id');
            $table->string('trimestre');
            $table->string('annee_scolaire')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiments');
    }
}
