<?php

function app__is_listening():bool {
	$appstate = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/app/state.json'), true);
	return $appstate['isListening'];
}

function app__get_current_configuration():string {
	$appstate = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/app/state.json'), true);
	return $appstate['currentConfiguration'];
}

function app__get_current_experience():string {
	$appstate = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/app/state.json'), true);
	return $appstate['startedAt'] . '_' . $appstate['currentConfiguration'];
}