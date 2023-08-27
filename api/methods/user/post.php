<?php

/*
	POST user
		> creates a new user if not already existing
		> requires an email address
	only one registered user is authorized
*/


if (user_exists())
	json_put(ERR_USER_ALREADYEXISTS);

$user = [
	'email'		=> false,
	'password'	=> '',
	'token'		=> '',
	'signature'	=> ''
];

$schema = json_decode(file_get_contents(DATA_PUBLIC_DIR . '/schemas/login-step-1.json'), true);
if (!json_validate($request['data'], $schema))
	json_puterror(ERR_DATA_INVALID);

$user['email'] = $request['data']['email'];
$user['token'] =  uniqid();
$password = strtoupper(bin2hex(random_bytes(2)));
$user['password'] = password_hash($password, PASSWORD_DEFAULT);
$user['signature'] = user_hashsignature();

$user_filepath = DATA_PUBLIC_DIR . '/user/1.json';
if (!file_put_contents($user_filepath, json_encode($user), LOCK_EX))
	json_put(ERR_FILE_CREATION);

if (!mail($user['email'], 'Your Phyphox code', 'Your code is : ' . $password, 'From: phyphox@' . $_SERVER['SERVER_NAME']))
	json_puterror(ERR_EMAIL_NOTSENT);

json_put(true);