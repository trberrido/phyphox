<?php

/*
	GET
		simply display a collection (list of ressources),
		a single ressource, or a specific field of a ressource.
*/

// if no ressource is provided, display the list of ressources
if (!$request['ressource'] && strcmp($request['ressource'], '0') != 0)
	json__put(api__get_ressources($request['collection']));

// else display the ressource
$folder = DATA_PUBLIC_DIR . '/' . $request['collection'] . '/';
$file_path =  $folder . $request['ressource'];

if (strcmp($request['ressource'], 'last') == 0
	|| strcmp($request['ressource'], '0') == 0
	|| is_numeric($request['ressource'])){

	$index = 0;
	if (is_numeric($request['ressource']))
		$index = $request['ressource'] + 0;
	$ressources = glob($folder . '*.{*}', GLOB_BRACE);
	sort__time($ressources);
	if ($index >= count($ressources))
		json__puterror(ERR_RESSOURCE_INVALID);
	$file_path = $ressources[$index];
}

if (!file_exists($file_path))
	json__puterror(ERR_RESSOURCE_INVALID);

$ressource = file_get_contents($file_path);

echo($ressource);