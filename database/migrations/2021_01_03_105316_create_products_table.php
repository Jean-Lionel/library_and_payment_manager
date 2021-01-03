<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
          
            $table->string('name');
            $table->string('marque');
            $table->string('unite_mesure')->nullable();
            $table->float('quantite');
            $table->float('quantite_alert')->nullable();
            $table->double('price',62,2);
            $table->double('price_max',62,2)->nullable();
            $table->double('price_min',62,2)->nullable();
            $table->date('date_expiration')->nullable();
            $table->text('description')->nullable();

            $table->foreignId('category_id');
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
        Schema::dropIfExists('products');
    }
}
