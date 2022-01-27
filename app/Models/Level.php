<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'section_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'section_id' => 'integer',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function classes()
    {
        return $this->hasMany(Classe::class);
    }

    public function getStudentByAnneScolaireId($anne_scolaire_id){
        $garcons = 0;
        $filles = 0;
        $total = 0;

        foreach ($this->classes as $key => $classe) {    
          $resultat =  $classe->getEffectifParClasse($anne_scolaire_id);
            $garcons += $resultat['g'];
            $filles += $resultat['f'];;
            
        }

        $total = $garcons + $filles;
        return  [
            "name" => $this->name ,
            "g" => $garcons, 
            "p_g" => getPourcentage($garcons , $total ), 
            "f" => $filles,
            "p_f" => getPourcentage($filles , $total ),
            "total" =>  $total
        ];
    }
}
