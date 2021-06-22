<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("evaluation_id");
            $table->foreignId("eleve_id");
            $table->double("point_obtenu");
            $table->double("ponderation")->nullable();
            $table->foreignId("cour_id");
            $table->foreignId("classe_id")->nullable();
            $table->foreignId("trimestre_id");
            $table->foreignId("anne_scolaire_id");
            $table->string("type_evaluation")->nullable();
            $table->text("description")->nullable();
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
        Schema::dropIfExists('point_evaluations');
    }
}
