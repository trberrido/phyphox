<?php

/*
	POST
		creates a new ressource
*/

$input_data = file_get_contents('php://input');
if (!$input_data || !json__check_input($input_data))
	json__puterror(ERR_DATA_INVALID);

$input_data = json_decode($input_data, true);
//$input_data['title'] = filter_var(preg_replace('/\s+/', '', $input_data['title']), FILTER_SANITIZE_STRING);
$project_id = uniqid();
$input_data['id'] = $project_id;
$filename = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $project_id . '.json';
if (!file_put_contents($filename, json_encode($input_data), LOCK_EX))
	json__puterror(ERR_FILE_CREATION);
json__put(api_getressourceinfo($filename));

