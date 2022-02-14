<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElevesTable extends Migration
{
    /**
     * 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('sexe')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('address')->nullable();
            $table->string('anne_scolaire');
            $table->foreignId('anne_scolaire_id');
            $table->foreignId('parent_id')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('classe_id');
            
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
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
        Schema::dropIfExists('eleves');
    }
}
