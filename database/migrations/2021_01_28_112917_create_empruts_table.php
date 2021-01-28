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
