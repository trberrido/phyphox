<?php

/*
	GET user
		> used to check authentification if ressource is set
		> otherwise, tells if an admin user already exists or not
*/

if ($request['ressource'] == '1.json')
	json_put(user_isauthorized());

json_put(user_exists());