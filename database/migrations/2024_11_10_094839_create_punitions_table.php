<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePunitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punitions', function (Blueprint $table) {
            $table->id();
            $table->string('type_punition_id');
            $table->text('description')->nullable();
            $table->date('date_punition');
            $table->string('statut')->default('en_cours');
            $table->string('eleve_id');
            $table->string('enseignant_id')->nullable();
            $table->string('user_id');
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
        Schema::dropIfExists('punitions');
    }
}
