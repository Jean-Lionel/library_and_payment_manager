<?php

use App\Models\Cour;
use App\Models\PointEvaluation;


if(!function_exists('dire_bonjour')){
	function dire_bonjour(string $message="") : string
	{
		return "Bonjour ". $message;
	}
}

function setActiveRoute(string $route): string
{
	return Route::is($route) ? "active" : "";
}

//Cart function 

function searchProduct($id)
{

	foreach (Cart::content() as $cartItem) {
		if($cartItem->model->id === $id)
			return true;

	}

	return false;
}


function getPrice($price, $type="FBU")
{
	
	$price = floatval($price);
	return number_format($price, 2,',',' . ') ." ". $type;
}

function addTwoNumber($a , $b){
	$res = floatval($a) + floatval($b);
	return $res != 0 ? $res :  "";
}
function addTreeNumber($a , $b,$c){
	$res = floatval($a) + floatval($b) +floatval($c) ;
	return $res != 0 ? $res :  "";
}

function getPourcentage($a , $b){
	$res = 0;
	if(floatval($b) != 0)
		$res = floatval($a) * 100 / floatval($b);

	return $res != 0 ? number_format($res,2,'.', ' ') :  "";
}


function recuperer_point($eleve_id = "" ,$cour_id, $trimestre_id, $anne_scolaire_id, $type_evaluation ){
        $points = PointEvaluation::where('cour_id', '=', $cour_id)
                                    ->where('eleve_id','=',$eleve_id)
                                    ->where('trimestre_id','=',$trimestre_id)
                                    ->where('anne_scolaire_id','=',$anne_scolaire_id)
                                    ->where('type_evaluation','=',$type_evaluation)
                                    ->get();

        //CALCULER LA MOYENNE SUR 
        $ponderation = Cour::findOrFail($cour_id)->ponderation;
        //POINT OBTENUE  MOYENNE DU COURS

        if($points->sum('ponderation') != 0){
        	 $resultat = $points->sum('point_obtenu') * $ponderation / $points->sum('ponderation');
        }else{
        		$resultat = ' ';
        }
       

        return $resultat;

    }