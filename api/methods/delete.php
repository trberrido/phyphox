<?php

/*
	DELETE
		delete a ressource
*/

if (!user_isauthorized())
	json_put(ERR_USER_NOTAUTHORIZED);

$folder = DATA_PUBLIC_DIR . '/' . $request['collection'] . '/';
$file_path =  $folder . $request['ressource'];
if (!file_exists($file_path))
	json_puterror(ERR_RESSOURCE_INVALID);

unlink($file_path);
json_put($request['ressource'] . ' deleted.');