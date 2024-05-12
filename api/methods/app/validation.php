<?php

/*
	validation with schema before updating ressource
*/

$schema = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/schemas/appstate.json'), true);

if (!$request['data'])
	json_puterror(ERR_DATA_INVALID);

if (!json_validate($request['data'], $schema))
	json_puterror(ERR_DATA_INVALID);