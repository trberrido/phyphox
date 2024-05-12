<?php

/*
	GET user
		> used to check authentification if ressource is set
		> otherwise, tells if an admin user already exists or not
*/

if ($request['ressource'] == '1.json')
	json__put(user__is_authorized());

json__put(user__exists());