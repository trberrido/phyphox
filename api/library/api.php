<?php

/* api_ functions */

function api__get_collections(): array {
	$api = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/api.json'), true);
	return ($api['collections']);
}

function api__get_ressource_info(string $file_path): array {

	$ressourceinfos = [
		'id'		=> pathinfo($file_path, PATHINFO_FILENAME),
		'date'		=> date('H:i:s d/m/Y', filemtime($file_path)),
		'filename' 	=> basename($file_path),
		'filesize' 	=> filesize($file_path)
	];

	$file = @json_decode(file_get_contents($file_path), true);

	if (!isset($file))
		$ressourceinfos['title'] = basename($file_path);
	else if (is_array($file) && array_key_exists('title', $file))
		$ressourceinfos['title'] = $file['title'];

	return $ressourceinfos;

}

function api__get_ressources(string $collection): array {
	$ressources = glob(DATA_PUBLIC_DIR . '/' . $collection . '/*');
	sort__time($ressources);
	$ressources = array_map(
		'api__get_ressource_info',
		$ressources
	);
	return ($ressources);
}

function api__get_request():array {

	$request = [
		'method'		=> false,
		'collection'	=> false,
		'ressource'		=> false,
		'items'			=> false,
		'data'			=> false
	];

	$collections_available = api__get_collections();

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

/*
	creates the required folders if the PUBLIC folder does not exist
*/

function api__init_public_folders():bool {

	if (file_exists(DATA_PUBLIC_DIR))
		return true;

	if (!@mkdir(DATA_PUBLIC_DIR, 0775, true))
		return false;

	$folders = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/api.json'), true);
	foreach ($folders['collections'] as $folder_name => $methods){
		if (!@mkdir(DATA_PUBLIC_DIR . '/' . $folder_name, 0775, true))
			return false;
	}

	return true;

}