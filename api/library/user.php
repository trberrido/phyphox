<?php

/*
	user_ functions
*/

function user__hash_signature() {
	return (hash('sha512', $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']));
}

function user__exists(){

	$user_filepath = DATA_PUBLIC_DIR . '/user/1.json';
	if (file_exists($user_filepath)){
		$user = json_decode(file_get_contents($user_filepath), true);
		if (isset($user['email']) && filter_var($user['email'], FILTER_VALIDATE_EMAIL))
			return true;
	}

	return false;

}

function user__is_authorized(){

	if (isset($_COOKIE[COOKIE_KEY_TOKEN])){

		$filename = DATA_PUBLIC_DIR . '/user/1.json';
		if (!file_exists($filename))
			return false;
		$user_config = json_decode(file_get_contents($filename), true);
		if ($_COOKIE[COOKIE_KEY_TOKEN] == $user_config['token']
			&& user__hash_signature() == $user_config['signature']){
				header('Set-Cookie: ' . COOKIE_KEY_TOKEN . '=' . $user_config['token'] . '; path=/; domain=' . $_SERVER['SERVER_NAME'] . '; Max-Age=' . COOKIE_MAX_AGE . '; Secure; HttpOnly; SameSite=None;');
				return true;
		}

	}

	return false;

}