<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrimoinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrimoines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->double('quantite_total',62,2);
            $table->double('qte_en_mauvaise_etat',62,2);
            $table->double('quantite_en_bonne_etat',62,2);
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
        Schema::dropIfExists('patrimoines');
    }
}
