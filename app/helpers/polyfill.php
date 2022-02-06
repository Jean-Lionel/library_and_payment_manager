<?php
$languepreferee = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);

if (!function_exists('str_contains')) {
    function str_contains (string $haystack, string $needle)
    {
        return empty($needle) || strpos($haystack, $needle) !== false;
    }
}