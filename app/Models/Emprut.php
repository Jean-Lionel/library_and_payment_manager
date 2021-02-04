<?php

namespace App\Models;

use App\Models\DetailEmprunt;
use App\Models\Eleve;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Emprut extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public static function boot(){
    	parent::boot();

    	self::creating(function($model){
    		$model->user_id = Auth::user()->id ?? 0;
    	});
    }

    public function detailsBooks()
    {
    	return $this->hasMany(DetailEmprunt::class);
    }

    public function eleve(){
        return $this->belongsTo(Eleve::class);
    }
}
