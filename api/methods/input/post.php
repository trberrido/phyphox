<?php

/*
	POST
		create ressource from data sent by the smarthone app if the app is listening
		+ for debug : save all the data received in raw/, whatever the app state is
*/

// remove old raw files before saving a new one
$folder = DATA_PUBLIC_DIR . '/raw/';
$ressources = glob($folder . '*.{*}', GLOB_BRACE);
$now = time();
$timelimite = 60 * 60;
foreach($ressources as $ressource){
	if ($now - filemtime($ressource) >= $timelimite)
		unlink($ressource);
}

if (!json__check_input(file_get_contents('php://input'))){
	json__puterror(ERR_DATA_INVALID);
}

$request['data'] = json_decode(file_get_contents('php://input'));
$rawfilename = DATA_PUBLIC_DIR . '/raw/' . uniqid() . '.json';
file_put_contents($rawfilename, json_encode($request['data']), LOCK_EX);

// debug is done, below the normal process
// storing in input/

if (!app__is_listening())
	json__puterror(APPSTATE_ISCLOSED);

$schema = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/schemas/input.json'), true);
if (!json__validate($request['data'], $schema))
	json__puterror(ERR_DATA_INVALID);

$project_id = uniqid();
$filename = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $project_id . '.json';

if (!file_put_contents($filename, json_encode($request['data']), LOCK_EX))
	json__puterror(ERR_FILE_CREATION);

json__put(APPSTATE_ISOPEN);