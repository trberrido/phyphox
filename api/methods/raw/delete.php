<?php

/*
	DELETE
		delete a ressource or all ressources
*/

$folder = DATA_PUBLIC_DIR . '/' . $request['collection'] . '/';

if (strcmp($request['ressource'], 'all') == 0){
	$ressources = glob($folder . '*.{*}', GLOB_BRACE);
	
	if (!count($ressources))
		json_puterror(ERR_RESSOURCE_INVALID);

	foreach ($ressources as $ressource)
		unlink($ressource);
	json_put('all ressources deleted.');
}

if (!$request['ressource'])
	json_puterror(ERR_RESSOURCE_INVALID);

$file_path =  $folder . $request['ressource'];
if (!file_exists($file_path))
	json_puterror(ERR_RESSOURCE_INVALID);

unlink($file_path);
json_put($request['ressource'] . ' deleted.');