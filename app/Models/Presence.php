<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function eleves(){
        // presences

        return $this->hasMany(Eleve::class , 'eleve_id');
    }
    public function eleve(){
        // presences

        return $this->belongsTo(Eleve::class , 'eleve_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
}
