<?php

/* api_ functions */

/* returns the list names of the available collections */

function api_getcollections(){
	$api = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/api.json'), true);
	return ($api['collections']);
}

/* returns ressource's formated data */ 

function api_getressourceinfo($file_path){
	return [
		'id'		=> pathinfo($file_path, PATHINFO_FILENAME),
		'date'		=> date('H:i:s d/m/Y', filemtime($file_path)),
		'filename' 	=> basename($file_path),
		'filesize' 	=> filesize($file_path)
	]; 
}

/* 
	takes a collection's name
	returns the list of ressources data
*/

function api_getressources($collection){
	$ressources = glob(DATA_PUBLIC_DIR . '/' . $collection . '/*.json');
	sort_time($ressources);
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
	
	$user_request = url_explode();
	array_shift($user_request);
	
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
