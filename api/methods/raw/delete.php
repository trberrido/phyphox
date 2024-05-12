<?php

/*
	DELETE
		delete a ressource or all ressources
*/

$folder = DATA_PUBLIC_DIR . '/' . $request['collection'] . '/';

if (strcmp($request['ressource'], 'all') == 0){
	$ressources = glob($folder . '*.{*}', GLOB_BRACE);

	if (!count($ressources))
		json__puterror(ERR_RESSOURCE_INVALID);

	foreach ($ressources as $ressource)
		unlink($ressource);
	json__put('all ressources deleted.');
}

if (!$request['ressource'])
	json__puterror(ERR_RESSOURCE_INVALID);

$file_path =  $folder . $request['ressource'];
if (!file_exists($file_path))
	json__puterror(ERR_RESSOURCE_INVALID);

unlink($file_path);
json__put($request['ressource'] . ' deleted.');