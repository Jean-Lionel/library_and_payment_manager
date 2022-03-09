<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Burundizipcode extends Model
{
    use HasFactory;

    public static function provinces(){

        try {
            $data = DB::select('SELECT DISTINCT region FROM burundizipcodes');
        } catch (\Exception $e) {
            $data = null;
        }
        return $data;
    }

    public static function communes($province = ""){
         $data = DB::select("SELECT DISTINCT district FROM `burundizipcodes` WHERE region='$province'");

        return $data;

    }

    public static function collines($commune = ""){
         $data = DB::select("SELECT DISTINCT city FROM `burundizipcodes` WHERE district='$commune'");
        
        return $data;

    }

    public static function zipcode($province="", $commune ="", $colline = "" ){

    }

}
