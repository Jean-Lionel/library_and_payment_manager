<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Paiment extends Model
{
    use HasFactory,Sortable;

    protected $guarded=[];


    public function eleve(){
    	return $this->belongsTo('App\Models\Eleve', 'eleve_id', 'id');
    }
}
