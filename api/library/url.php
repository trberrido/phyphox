<?php

/*
	Filters URL request
		removing all non alpha-numerical chars
		if presents, removes site subfolder from URL
	Returns an array of meaning parameters.
*/

function url_explode(){

	$url = trim($_SERVER['REQUEST_URI'], "/");
	$requests = explode('/', $url);
	$requests = array_map(function($str) { return str_sanitizestrict($str); }, $requests);

	$config = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/config.json'));
	$site_path = explode('/', trim($config->directory, "/"));
	if (!count($site_path))
		return $requests;

	foreach($site_path as $directory){
		if (!strlen($directory))
			break;
		if ($directory == $requests[0]){
			array_shift($requests);
		} else {
			json_puterror(ERR_URL_INVALID);
		}
	}

	if (!count($requests))
		$requests = [''];

	return $requests;

}