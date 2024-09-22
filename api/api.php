<?php

if (version_compare(PHP_VERSION, '8.0.0', '<')){
	header('Content-Type: application/json');
	echo json_encode(array('error' => 'PHP version 8.0.0 or higher is required'));
	exit();
}

foreach (glob('library/*.php') as $php_file)
	include_once $php_file;

/*
	We need to ensure this api will be able
	owns enough permission to write files
*/

if (!api__init_public_folders())
	json__puterror(ERR_PERMISSIONS);

$api = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/api.json'), true);
$request = api__get_request();

if (!$request['collection'])
	json__put(array_keys($api['collections']));

if (!array_key_exists($request['collection'], $api['collections']))
	json__puterror(ERR_COLLECTION_INVALID);

$api_requestedcollection = $api['collections'][ $request['collection'] ];
if (!array_key_exists($request['method'], $api_requestedcollection['methods']))
	json__puterror(ERR_HTTPMETHOD_INVALID);

foreach ($api_requestedcollection['methods'][ $request['method'] ] as $file)
	include_once $file;