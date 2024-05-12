<?php

/*
	POST
		create ressource from the smarthone app
		if the admin user had opened an experiment
*/


// for debug : save all the data received in raw/
$folder = DATA_PUBLIC_DIR . '/raw/';
$ressources = glob($folder . '*.{*}', GLOB_BRACE);
$now = time();
$timelimite = 60 * 60;
foreach($ressources as $ressource){
	if ($now - filemtime($ressource) >= $timelimite)
		unlink($ressource);
}

$request['data'] = json_decode(file_get_contents('php://input'));
$rawfilename = DATA_PUBLIC_DIR . '/raw/' . uniqid() . '.json';
file_put_contents($rawfilename, json_encode($request['data']), LOCK_EX);

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