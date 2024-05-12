<?php

/*
	PUT user used for login / logout
		> update the user password
	PUT to login is called in two steps :
		1: validate email, set signature, and send password by mail
		2: validate email, signature, password and cookie
	PUT with no data = logout
*/

if (!user__exists())
	json__puterror(ERR_HTTPMETHOD_INVALID);

$user__registered__filename = DATA_PUBLIC_DIR . '/user/1.json';
$user__on_hold__filename = DATA_PUBLIC_DIR . '/user/1.onhold.json';

$user_registered = json_decode(file_get_contents($user__registered__filename), true);
$user__on_hold = array();

/*
	login first call
*/

if (isset($request['data']['email']) && !(isset($request['data']['password']))){

	$schema = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/schemas/login-step-1.json'), true);
	if (!json__validate($request['data'], $schema))
		json__puterror(ERR_DATA_INVALID);

	if ($user_registered['email'] != $request['data']['email'])
		json__puterror(ERR_EMAIL);

	$password = strtoupper(bin2hex(random_bytes(2)));
	$user__on_hold['password'] = password_hash($password, PASSWORD_DEFAULT);
	$user__on_hold['token'] =  uniqid();
	$user__on_hold['signature'] = user__hash_signature();
	file_put_contents($user__on_hold__filename, json_encode($user__on_hold));

	if (!mail($user_registered['email'], 'Your Phyphox code', 'Your code is : ' . $password, 'From: phyphox@' . $_SERVER['SERVER_NAME']))
		json__puterror(ERR_EMAIL_NOTSENT);
	json__put(true);

}

/*
	login second call
*/

if (isset($request['data']['email']) && isset($request['data']['password'])){

	$schema = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/schemas/login-step-2.json'), true);
	if (!json__validate($request['data'], $schema))
		json__puterror(ERR_DATA_INVALID);

	$user__on_hold = json_decode(file_get_contents($user__on_hold__filename), true);
	if (user__hash_signature() != $user__on_hold['signature'])
		json__puterror(ERR_DATA_INVALID);

	if (!password_verify($request['data']['password'], $user__on_hold['password']))
		json__puterror(ERR_PASSWORD);

	if ($request['data']['email'] != $user_registered['email'])
		json__puterror(ERR_EMAIL);

	$user__on_hold['token'] = uniqid();
	$user__on_hold['email'] = $user_registered['email'];
	if (file_put_contents($user__registered__filename, json_encode($user__on_hold)) === false)
		json__puterror(ERR_FILE_EDIT);

	unlink($user__on_hold__filename);
	header('Set-Cookie: ' . COOKIE_KEY_TOKEN . '=' . $user__on_hold['token'] . '; path=/; domain=' . $_SERVER['SERVER_NAME'] . '; Max-Age=' . COOKIE_MAX_AGE . '; Secure; HttpOnly; SameSite=None;');
	json__put(true);

}

/*
	logout
*/

if (user__is_authorized()){

	$user_registered['password'] = '';
	$user_registered['token'] =  uniqid();
	$user_registered['signature'] = '';
	file_put_contents($user__registered__filename, json_encode($user_registered));
	header('Set-Cookie: ' . COOKIE_KEY_TOKEN . '=____;  path=/; domain=' . $_SERVER['SERVER_NAME'] . '; Max-Age=' . COOKIE_MAX_AGE . '; Secure; HttpOnly; SameSite=None;');
	json__put(true);

}

json__puterror(ERR_DATA_INVALID);