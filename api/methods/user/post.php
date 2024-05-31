<?php

/*
	POST user
		> creates a new user if not already existing
		> requires an email address
	only one registered user is authorized
*/


if (user__exists())
	json__put(ERR_USER_ALREADYEXISTS);

$new_user__onhold__filename = DATA_PUBLIC_DIR . '/user/1.onhold.json';

/*
	login first call
*/

if (isset($request['data']['email']) && !(isset($request['data']['password']))){

	$new_user = [
		'email'		=> false,
		'password'	=> '',
		'token'		=> '',
		'signature'	=> ''
	];

	$schema = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/schemas/login-step-1.json'), true);
	if (!json__validate($request['data'], $schema))
		json__puterror(ERR_DATA_INVALID);

	$new_user['email'] = $request['data']['email'];
	$new_user['token'] =  uniqid();
	$password = strtoupper(bin2hex(random_bytes(2)));
	$new_user['password'] = password_hash($password, PASSWORD_DEFAULT);
	$new_user['signature'] = user__hash_signature();

	if (!file_put_contents($new_user__onhold__filename, json_encode($new_user), LOCK_EX))
		json__put(ERR_FILE_CREATION);

	if (!mail($new_user['email'], 'Your Phyphox code', 'Your code is : ' . $password, 'From: phyphox@' . $_SERVER['SERVER_NAME']))
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

	$new_user = json_decode(file_get_contents($new_user__onhold__filename), true);
	if (user__hash_signature() != $new_user['signature'])
		json__puterror(ERR_DATA_INVALID);

	if (!password_verify($request['data']['password'], $new_user['password']))
		json__puterror(ERR_PASSWORD);

	if ($request['data']['email'] !== $new_user['email'])
		json__puterror(ERR_EMAIL);

	$new_user['token'] =  uniqid();

	if (file_put_contents(DATA_PUBLIC_DIR . '/user/1.json', json_encode($new_user)) === false)
		json__puterror(ERR_FILE_EDIT);

	unlink($new_user__onhold__filename);
	header('Set-Cookie: ' . COOKIE_KEY_TOKEN . '=' . $new_user['token'] . '; path=/; domain=' . $_SERVER['SERVER_NAME'] . '; Max-Age=' . COOKIE_MAX_AGE . '; Secure; HttpOnly; SameSite=None;');
	json__put(true);

}

json__puterror(ERR_DATA_INVALID);