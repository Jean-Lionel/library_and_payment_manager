<?php

namespace App\Models;

use App\Models\Eleve;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parent extends Model
{
    use HasFactory;

    protected guarded = [];

    public function enfant(){
        return $this->hasMany(Eleve::class);
    }
}
