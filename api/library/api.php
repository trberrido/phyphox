<?php

/* api_ functions */

/* returns the list names of the available collections */

function api_getcollections(){
	$api = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/api.json'), true);
	return ($api['collections']);
}

/* returns ressource's formated data */

function api_getressourceinfo($file_path){

	$ressourceinfos = [
		'id'		=> pathinfo($file_path, PATHINFO_FILENAME),
		'date'		=> date('H:i:s d/m/Y', filemtime($file_path)),
		'filename' 	=> basename($file_path),
		'filesize' 	=> filesize($file_path)
	];

	$file = json_decode(file_get_contents($file_path), true);
	if ($file === null)
		json__puterror('The following file contains an error and must be removed: ' . basename($file_path));

	if (array_key_exists('title', $file))
		$ressourceinfos['title'] = $file['title'];

	return $ressourceinfos;

}

/*
	takes a collection's name
	returns the list of ressources data
*/

function api_getressources($collection){
	$ressources = glob(DATA_PUBLIC_DIR . '/' . $collection . '/*.json');
	sort__time($ressources);
	$ressources = array_map(
		'api_getressourceinfo',
		$ressources
	);
	return ($ressources);
}

/*
	parses the URL into
	[ method / collection / ressource ] associative array
*/

function api_getrequest(){

	$request = [
		'method'		=> false,
		'collection'	=> false,
		'ressource'		=> false,
		'items'			=> false,
		'data'			=> false
	];

	$collections_available = api_getcollections();

	$user_request = url__parse();

	if ($_SERVER['REQUEST_METHOD'])
		$request['method'] = $_SERVER['REQUEST_METHOD'];

	if (count($user_request))
		$request['collection'] = $user_request[0];

	if (count($user_request) > 1)
		$request['ressource'] = $user_request[1];

	if (count($user_request) > 2)
		$request['items'] = array_slice($user_request, 2);

	$request['data'] = json_decode(file_get_contents('php://input'), true);

	return $request;

}

function api_initpublicfolder(){
	if (file_exists(DATA_PUBLIC_DIR))
		return true;
	if (!mkdir(DATA_PUBLIC_DIR))
		return false;
	$folders = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/api.json'), true);
	foreach ($folders['collections'] as $folder_name => $methods){
		if (!mkdir(DATA_PUBLIC_DIR . '/' . $folder_name))
			return false;
	}
	return true;
}
