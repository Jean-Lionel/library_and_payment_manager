<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetraitLivresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retrait_livres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id');
            $table->string('isbn')->nullable();
            $table->float('quantite');
            $table->string('status'); //RETIRE OU NON
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
        Schema::dropIfExists('retrait_livres');
    }
}
