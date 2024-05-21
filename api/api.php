<?php

/*
	Entry point of the api,
	filters wrong requests, then
	includes files related to request
		by default, all the non-safe operations
		require authorization
*/

foreach (glob('library/*.php') as $php_file)
	include_once $php_file;

if (version_compare(PHP_VERSION, PHP_REQUIRED_VERSION, '<'))
	json__puterror(ERR_OUTTADED_REQUIREMENTS);

if (!api__init_public_folders())
	json_puterror(ERR_PERMISSIONS);

$api = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/api.json'), true);
$request = api__get_request();

if (!$request['collection'])
	json__puterror(ERR_COLLECTION_INVALID);

if (!array_key_exists($request['collection'], $api['collections']))
	json__puterror(ERR_COLLECTION_INVALID);

$api_requestedcollection = $api['collections'][ $request['collection'] ];
if (!array_key_exists($request['method'], $api_requestedcollection['methods']))
	json__puterror(ERR_HTTPMETHOD_INVALID);

foreach ($api_requestedcollection['methods'][ $request['method'] ] as $file)
	include_once $file;