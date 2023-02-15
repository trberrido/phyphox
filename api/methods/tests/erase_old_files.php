<?php

$folder = DATA_PUBLIC_DIR . '/' . $request['collection'] . '/';
$ressources = glob($folder . '*.json');

$now = time();
$timelimit = 60 * 60 * 24 * 2;
foreach ($ressources as $ressource){
	if ($now - filemtime($ressource) > $timelimit)
		unlink($ressource);
}