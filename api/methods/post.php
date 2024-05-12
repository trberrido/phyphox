<?php

/*
	POST
		creates a new ressource
		unless it receives an existing ressource name -> a copy will be made
*/

if (!user__is_authorized())
	json__puterror(ERR_USER_NOTAUTHORIZED);

if (!$request['collection'])
	json__puterror(ERR_COLLECTION_INVALID);

if ($request['ressource']){

	/*
		Duplicate an already existing ressource
	*/

	$filepath = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $request['ressource'];
	if (!file_exists($filepath))
		json__puterror(ERR_RESSOURCE_INVALID);

	$content = json_decode(file_get_contents($filepath), true);
	$fileid = substr($content['id'], strpos($content['id'], '_') + 1);
	$content['id'] = uniqid() . '_' . $fileid;
	$filename_copy = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $content['id'] . '.json';
	if (!file_put_contents($filename_copy, json_encode($content), LOCK_EX))
		json__puterror(ERR_FILE_CREATION);
	json__put(api_getressourceinfo($filename_copy));

} else {

	/*
		Create a new ressource
	*/

	if (!$request['data'])
		json__puterror(ERR_DATA_INVALID);

	$request['data'] = file_get_contents('php://input');
	if (!$request['data'] || !json__check_input($request['data']))
		json__puterror(ERR_DATA_INVALID);

	$request['data'] = json_decode($request['data'], true);
	//$request['data']['title'] = filter_var(preg_replace('/\s+/', '', $request['data']['title']), FILTER_SANITIZE_STRING);
	$project_id = uniqid() . '_' . str__sanitize_strict($request['data']['title']);
	$request['data']['id'] = $project_id;
	$filename = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $project_id . '.json';
	if (!file_put_contents($filename, json_encode($request['data']), LOCK_EX))
		json__puterror(ERR_FILE_CREATION);
	json__put(api_getressourceinfo($filename));

}
