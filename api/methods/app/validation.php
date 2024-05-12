<?php

/*
	validation with schema before updating ressource
*/

$schema = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/schemas/appstate.json'), true);

if (!$request['data'])
	json__puterror(ERR_DATA_INVALID);

if (!json__validate($request['data'], $schema))
	json__puterror(ERR_DATA_INVALID);