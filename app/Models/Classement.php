<?php

namespace App\Models;

use App\Models\Etagere;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function etager()
    {
    	return $this->belongsTo('App\Models\Etagere',  'etagere_id','id');
    }
}
