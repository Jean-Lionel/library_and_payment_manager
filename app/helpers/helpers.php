<?php


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
