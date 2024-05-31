<?php

/*
	PUT, updates the specified ressource and displays it
*/

if (!user__is_authorized())
	json__puterror(ERR_USER_NOTAUTHORIZED);

if (!$request['collection'] || !$request['ressource'])
	json__puterror(ERR_RESSOURCE_INVALID);

if (!$request['data'])
	json__puterror(ERR_DATA_INVALID);

$filename = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $request['ressource'];
if (!file_put_contents($filename, json_encode($request['data']), LOCK_EX))
	json__puterror(ERR_FILE_CREATION);

json__put(api__get_ressource_info($filename));