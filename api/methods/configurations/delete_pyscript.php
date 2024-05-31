<?php

/*
	DELETE configuration
		delete related py scripts
*/

if (!user__is_authorized())
	json__put(ERR_USER_NOTAUTHORIZED);

$folder = DATA_PUBLIC_DIR . '/' . $request['collection'] . '/';
$file_path =  $folder . $request['ressource'];
if (!file_exists($file_path))
	json__puterror(ERR_RESSOURCE_INVALID);

$configuration = json_decode(file_get_contents($file_path), true);

$index = 0;
foreach ($configuration['visualizations'] as $visualization){

	$pythonfile = $visualization['pythonfile'];

	if (!empty($pythonfile['name']))
		unlink(DATA_PUBLIC_DIR . '/scripts/' . $request['ressource'] . '_' . $index . '.py');

	$index += 1;

}