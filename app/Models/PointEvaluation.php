<?php

namespace App\Models;

use App\Models\Eleve;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PointEvaluation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function eleve(){
         return $this->belongsTo(Eleve::class, 'eleve_id','id');
    }

    
}
