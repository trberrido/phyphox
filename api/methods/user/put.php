<?php

/*
	PUT user used for login / logout
		> update the user password
	PUT to login is called in two steps :
		1: validate email, set signature, and send password by mail
		2: validate email, signature, password and cookie
	PUT with no data = logout
*/

if (!user_exists())
	json_puterror(ERR_HTTPMETHOD_INVALID);

$filename = DATA_PUBLIC_DIR . '/user/1.json';
$user = json_decode(file_get_contents($filename), true);

/* 
	login first call
*/

if (isset($request['data']['email']) && !(isset($request['data']['password']))){

	$schema = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/schemas/login-step-1.json'), true);
	if (!json_validate($request['data'], $schema))
		json_puterror(ERR_DATA_INVALID);

	if ($user['email'] != $request['data']['email'])
		json_puterror(ERR_EMAIL);

	$password = strtoupper(bin2hex(random_bytes(2)));
	$user['password'] = password_hash($password, PASSWORD_DEFAULT);
	$user['token'] =  uniqid();
	$user['signature'] = user_hashsignature();
	file_put_contents($filename, json_encode($user));
	
	if (!mail($user['email'], 'Your Phyphox code', 'Your code is : ' . $password, 'From: phyphox@' . $_SERVER['SERVER_NAME']))
		json_puterror(ERR_EMAIL_NOTSENT);
	json_put(true);

}

/*
	login second call
*/

if (isset($request['data']['email']) && isset($request['data']['password'])){

	$schema = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/schemas/login-step-2.json'), true);
	if (!json_validate($request['data'], $schema))
		json_puterror(ERR_DATA_INVALID);
	
	if (user_hashsignature() != $user['signature'])
		json_puterror(ERR_DATA_INVALID);
	
	if (!password_verify($request['data']['password'], $user['password']))
		json_puterror(ERR_PASSWORD);
	
	if ($request['data']['email'] != $user['email'])
		json_puterror(ERR_EMAIL);

	$user['token'] = uniqid();
	file_put_contents($filename, json_encode($user));
	header('Set-Cookie: ' . COOKIE_KEY_TOKEN . '=' . $user['token'] . '; path=/; domain=' . $_SERVER['SERVER_NAME'] . '; Max-Age=10800; Secure; HttpOnly; SameSite=None;');
	json_put(true);	
	
} 

/*
	logout
*/

if (user_isauthorized()){

	$user['password'] = '';
	$user['token'] =  uniqid();
	$user['signature'] = '';
	file_put_contents($filename, json_encode($user));
	header('Set-Cookie: ' . COOKIE_KEY_TOKEN . '=____;  path=/; domain=' . $_SERVER['SERVER_NAME'] . '; Max-Age=10800; Secure; HttpOnly; SameSite=None;');
	json_put(true);

}

json_puterror(ERR_DATA_INVALID);