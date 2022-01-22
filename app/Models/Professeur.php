<?php

namespace App\Models;

use App\Models\cours;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professeur extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded= [];

    public function cours(){

        return $this->hasMany(cours::class);
    }
}
