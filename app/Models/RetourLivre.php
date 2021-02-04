<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RetourLivre extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
    	parent::boot();

    	self::creating(function($model){
    		$model->user_id = Auth::user()->id;
    		$model->date_retour = Carbon::now();

    	});

    }
}
