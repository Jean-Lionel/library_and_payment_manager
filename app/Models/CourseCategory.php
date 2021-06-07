<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded;

    public function courses(){
        return $this->hasMany('App\Models\Cour', 'category_id','id');
    }
}
