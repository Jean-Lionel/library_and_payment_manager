<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBurundizipcodesTable extends Migration
{
    /*

    DROP TABLE IF EXISTS `burundizipcodes`;
    CREATE TABLE `burundizipcodes` (
      `zipcode` varchar(255) DEFAULT NULL,
      `region` varchar(255) DEFAULT NULL,
      `district` varchar(255) DEFAULT NULL,
      `city` varchar(255) DEFAULT NULL,
      `oldzipcode` varchar(45) DEFAULT NULL,
      KEY `zipcode` (`zipcode`),
      KEY `district` (`district`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    */
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('burundizipcodes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       /*Schema::dropIfExists('burundizipcodes');*/ 
    }
}
