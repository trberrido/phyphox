<?php

// erase output copy older than 2 hour
$folder = DATA_PUBLIC_DIR . '/' . $request['collection'] . '/';
$ressources = glob($folder . '*.{*}', GLOB_BRACE);
$now = time();
$timelimite = 60 * 60 * 2;
foreach($ressources as $ressource){
	if ($now - filemtime($ressource) >= $timelimite)
		unlink($ressource);
}