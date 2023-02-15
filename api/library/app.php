<?php

function app_islistening(){
	$appstate = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/app/state.json'), true);
	return $appstate['isListening'];
}

function app_currentconfiguration(){
	$appstate = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/app/state.json'), true);
	return $appstate['currentConfiguration'];
}

function app_currentexperience(){
	$appstate = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/app/state.json'), true);
	return $appstate['startedAt'] . '_' . $appstate['currentConfiguration'];
}