<?php

/*
	POST
		create ressource from the smarthone app
		if the admin user had opened an experiment
*/


// for debug : save all the data received in raw/
$request['data'] = json_decode(file_get_contents('php://input'));
$rawfilename = DATA_PUBLIC_DIR . '/raw/' . uniqid() . '.json';
file_put_contents($rawfilename, json_encode($request['data']), LOCK_EX);

if (!app_islistening())
	json_puterror(APPSTATE_ISCLOSED);

$schema = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/schemas/input.json'), true);
if (!json_validate($request['data'], $schema))
	json_puterror(ERR_DATA_INVALID);

$project_id = uniqid();
$filename = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $project_id . '.json';

if (!file_put_contents($filename, json_encode($request['data']), LOCK_EX))
	json_puterror(ERR_FILE_CREATION);
	
json_put(APPSTATE_ISOPEN);