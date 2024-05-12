<?php

/*
	POST user
		> creates a new user if not already existing
		> requires an email address
	only one registered user is authorized
*/


if (user__exists())
	json__put(ERR_USER_ALREADYEXISTS);

$user = [
	'email'		=> false,
	'password'	=> '',
	'token'		=> '',
	'signature'	=> ''
];

$schema = json_decode(file_get_contents(DATA_PRIVATE_DIR . '/schemas/login-step-1.json'), true);
if (!json__validate($request['data'], $schema))
	json__puterror(ERR_DATA_INVALID);

$user['email'] = $request['data']['email'];
$user['token'] =  uniqid();
$password = strtoupper(bin2hex(random_bytes(2)));
$user['password'] = password_hash($password, PASSWORD_DEFAULT);
$user['signature'] = user__hash_signature();

$user_filepath = DATA_PUBLIC_DIR . '/user/1.onhold.json';
if (!file_put_contents($user_filepath, json_encode($user), LOCK_EX))
	json__put(ERR_FILE_CREATION);

if (!mail($user['email'], 'Your Phyphox code', 'Your code is : ' . $password, 'From: phyphox@' . $_SERVER['SERVER_NAME']))
	json__puterror(ERR_EMAIL_NOTSENT);

json__put(true);