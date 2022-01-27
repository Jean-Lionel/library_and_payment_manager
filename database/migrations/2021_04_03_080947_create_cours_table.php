<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('ponderation');
            $table->double('ponderation_compentance')->nullable();
            $table->double('ponderation_examen')->nullable();
            $table->double('credit')->nullable();
            // Pour dire si le cours est principale ou Pas 
            $table->boolean('status')->nullable();
            $table->foreignId('classe_id')->nullable();
            $table->foreignId('level_id');
            $table->foreignId('category_id')->nullabale();
            $table->foreignId('professeur_id')->nullable();
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
        Schema::dropIfExists('cours');
    }
}
