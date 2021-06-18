<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded =[];

    public function stock(){
    	return $this->belongsTo('App\Models\Stock');
    }
    public function products(){
        return $this->hasMany(Product::class, 'category_id','id');
    }
}
