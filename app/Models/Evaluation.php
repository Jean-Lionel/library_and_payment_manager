<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Evaluation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public static function boot(){
    	parent::boot();
    	self::creating(function($model){
    		$model->user_id = Auth::user()->id;
    	});
    	self::updating(function($model){
    		$model->user_id = Auth::user()->id;
    	});

    }

    public function classe(){
        return $this->belongsTo('App\Models\Classe');
    } 
    public function cour(){
        return $this->belongsTo('App\Models\Cour');
    }
}
