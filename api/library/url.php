<?php

/*
	Filters URL request
		removing all non alpha-numerical chars
		if presents, removes site subfolder from URL until /api/ included
	Returns an array of meaningfull parameters:
	[
		0 => collection,
		1 => ressource,
		2 => item1,
		3 => item2,
		4 => item3,
		...
	]
*/

function url_explode(){

	$url = trim($_SERVER['REQUEST_URI'], "/");
	$requests = explode('/', $url);
	$requests = array_map(function($str) { return str_sanitizestrict($str); }, $requests);

	$last_apidir_position = array_search('api', array_reverse($requests, true));
	if ($last_apidir_position === false)
		json_puterror(ERR_URL_INVALID);

	$requests = array_slice($requests, $last_apidir_position + 1);

	if (!count($requests))
		$requests = [''];

	return $requests;

}