<?php

/*
	DELETE
		delete a ressource
*/

if (!user__is_authorized())
	json__put(ERR_USER_NOTAUTHORIZED);

$folder = DATA_PUBLIC_DIR . '/' . $request['collection'] . '/';
$file_path =  $folder . $request['ressource'];
if (!file_exists($file_path))
	json__puterror(ERR_RESSOURCE_INVALID);

unlink($file_path);
json__put($request['ressource'] . ' deleted.');