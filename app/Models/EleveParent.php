<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EleveParent extends Model
{
    use HasFactory;
     use SoftDeletes;

    protected $guarded = [];

    public function enfant(){
        return $this->hasMany(Eleve::class);
    }
}
