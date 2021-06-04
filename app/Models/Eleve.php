<?php

namespace App\Models;

use App\Models\Emprut;
use App\Models\PointEvaluation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eleve extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['first_name','last_name','description','classe_id','anne_scolaire','anne_scolaire_id'];
    

    public function classe(){
    	return $this->belongsTo('App\Models\Classe');
    }

    public function compte(){
    	return $this->belongsTo('App\Models\Compte','id','eleve_id');

    }

    public function getFullNameAttribute(){
    	return $this->first_name .'  '. $this->last_name;
    }

    public static function getEleveById($id)
    {
        return self::find($id);
    }

    public function empruts()
    {
        return $this->hasMany(Emprut::class);
    }

    public function listeEmprutNonRemis()
    {
        return "JE suis cool";
    }

    // LES POINTS OBTENUES DANS UN EVALUATION


    public function point_obentu_evaluation($evaluation_id){

        $check = PointEvaluation::where('evaluation_id', '=',$evaluation_id)->where('eleve_id' ,'=',$this->id)->first();

        return  $check ?? new PointEvaluation;
    }

}
