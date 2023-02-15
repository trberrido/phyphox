<?php

/*
	PUT, updates the specified ressource and displays it
*/

if (!user_isauthorized())
	json_puterror(ERR_USER_NOTAUTHORIZED);

if (!$request['collection'] || !$request['ressource'])
	json_puterror(ERR_RESSOURCE_INVALID);

if (!$request['data'])
	json_puterror(ERR_DATA_INVALID);

$filename = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $request['ressource'];
if (!file_put_contents($filename, json_encode($request['data']), LOCK_EX))
	json_puterror(ERR_FILE_CREATION);
	
json_put(api_getressourceinfo($filename));
