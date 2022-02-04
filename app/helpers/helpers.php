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
		if($cartItem->model->id  === $id)
			return true;
	}
	return false;
}

function getPrice($price, $type="", $limit = 1, $separateur = '.' )
{
	$price = floatval($price);
	return number_format($price, $limit ,$separateur,' , ') ." ". $type;
}

function sumColumn($input, $column_key){

	$res = array_sum(array_column($input, $column_key));

	return getPrice($res, "",0);
}

function addTwoNumber($a , $b){
	$res = floatval($a) + floatval($b);
	return $res != 0 ? number_format($res,1,'.', ' ') :  "";
}
function addTreeNumber($a , $b,$c){
	$res = floatval($a) + floatval($b) +floatval($c) ;
	return $res != 0 ? number_format($res,1,'.', ' ') :  "";
}

function getPourcentage($a , $b){
	$res = 0;
	if(floatval($b) != 0)
		$res = floatval($a) * 100 / floatval($b);

	return $res != 0 ? number_format($res,1,'.', ' ') :  "0";
}

function afficherPoint($nombre){
	return getPrice($nombre);
}

function recuperer_point($eleve_id = "" ,$cour_id, $trimestre_id, $anne_scolaire_id, $type_evaluation ){

		// echo ' ELEVE ID '.$eleve_id.' COUR ID '.$cour_id.'  TRIMESTRE '. $trimestre_id.' anne_scolaire ID '. $anne_scolaire_id.' TYPE Evaluation ID '. $type_evaluation . '<br>' ;
        $points = PointEvaluation::where('cour_id', '=', $cour_id)
                                    ->where('eleve_id','=',$eleve_id)
                                    ->where('trimestre_id','=',$trimestre_id)
                                    ->where('anne_scolaire_id','=',$anne_scolaire_id)
                                    ->where('type_evaluation','=',$type_evaluation)
                                    ->get();

         // dd($eleve_id  ,$cour_id, $trimestre_id, $anne_scolaire_id, $type_evaluation);

        //CALCULER LA MOYENNE SUR 
        $ponderation = Cour::findOrFail($cour_id)->ponderation;
        //POINT OBTENUE  MOYENNE DU COURS

        if($points->sum('ponderation') != 0){
        	 $resultat = $points->sum('point_obtenu') * $ponderation / $points->sum('ponderation');
        	$resultat = number_format($resultat,1,'.', ' ');
        }else{
        		$resultat = ' ';
        }
        return $resultat;

    }