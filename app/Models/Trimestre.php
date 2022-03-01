<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    use HasFactory;
    protected $guarded;

    public static function current(){
        return self::where('is_current',1)->first();
    }
}
