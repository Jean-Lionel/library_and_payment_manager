<?php

use App\Models\Configuration;


function configuration(){

	$configuration = Configuration::latest()->first();

	return $configuration;
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

	return afficherPoint($res);
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

	return $res != 0 ? afficherPoint($res) :  "0";
}

function afficherPoint($val){

	if($val ==0){
		return '';
	}

	$numPointPosition = intval(strpos($val, '.'));
   	
    if ($numPointPosition === 0) { //$val is an integer
        return $val;
    }

    $decimal = substr($val,($numPointPosition +1),1);
    $number = substr($val,0,($numPointPosition));

    if($decimal >= 5)
    	return $number.'.5';

    if ( $decimal < 5) {
    	// code...
    	return $number;
    }

	return getPrice($val);
}


//HOMME = 1
//FILLE = 0
function affichePlace($place, $is_girl){

	if($place == 1){
		if ($is_girl == 0) {
			return 1 .' <sup>er</sup>';
		}else{
			return 1 .' <sup>ère</sup>';
		}
	}

	return  $place .' <sup>ème</sup>';

}




