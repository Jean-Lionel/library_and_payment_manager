<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmprutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empruts', function (Blueprint $table) {
            $table->id();
            $table->integer('eleve_id')->nullable();
            $table->integer('professeur_id')->nullable();
            $table->integer('lecteur_id')->nullable();
            $table->string('type_lecteur')->nullable();
            $table->string('etat')->nullable();
            $table->date('date_retrait');
            $table->date('date_retour');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('empruts');
    }
}
