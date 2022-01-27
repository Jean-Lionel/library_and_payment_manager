<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\CourseCategory;
use App\Models\Professeur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cour extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function classe(){
    	return $this->belongsTo(Classe::class);
    } 
    public function professeur(){
    	return $this->belongsTo(Professeur::class);
    }

    public function category(){
        return $this->belongsTo(CourseCategory::class,  'category_id','id');
    }

    public function isPrincipal(){
        return $this->status == 1;
    }
}
