<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('montant',62,2);
            $table->double('tax',62,2);
            // $table->double('tax',62,2);
            $table->double('amount_tax',60,2);
            $table->string('client')->nullabale();
            $table->text('details');
            $table->foreignId('user_id');
            $table->foreignId('eleve_id');
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
        Schema::dropIfExists('orders');
    }
}
