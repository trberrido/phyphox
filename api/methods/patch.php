<?php

/*
	PATCH
		receive a field
		and update the related ressource
*/

if (!user_isauthorized())
	json_puterror(ERR_USER_UNAUTH);

if (!$request['collection'])
	json_puterror(ERR_NO_COLLECTION);

if (!$request['ressource'])
	json_puterror(ERR_RESSOURCE_UNSET);

$filename = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $request['ressource'];
if (!file_exists($filename))
	json_puterror(ERR_NO_RESSOURCE);

$ressource = json_decode(file_get_contents($filename), true);

parse_str(file_get_contents('php://input'), $request['data']);

foreach ($request['data'] as $request_key => $request_value){
	if (isset($ressource[$request_key])){
		$ressource[$request_key] = $request_value;
	} else {
		json_puterror(ERR_FIELD_UNVALID);
	}
}
