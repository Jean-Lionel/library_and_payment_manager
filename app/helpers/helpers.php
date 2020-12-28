<?php


if(!function_exists('dire_bonjour')){
	function dire_bonjour(string $message="") : string
	{
		return "Bonjour ". $message;
	}
}

function setActiveRoute(string $route): string
{
	return $route=="lion" ? "active" : "";
}