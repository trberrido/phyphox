<?php

/*
	GET
		simply display a collection (list of ressources),
		a single ressource, or a specific field of a ressource.
*/

if (!$request['ressource'] && strcmp($request['ressource'], '0') != 0){

	json_put(api_getressources($request['collection']));

} else {

	$folder = DATA_PUBLIC_DIR . '/' . $request['collection'] . '/';
	$file_path =  $folder . $request['ressource'];

	if (strcmp($request['ressource'], 'last') == 0
		|| strcmp($request['ressource'], '0') == 0
		|| is_numeric($request['ressource'])){

		$index = 0;
		if (is_numeric($request['ressource']))
			$index = $request['ressource'] + 0;
		$ressources = glob($folder . '*.{*}', GLOB_BRACE);
		sort_time($ressources);
		if ($index >= count($ressources))
			json_puterror(ERR_RESSOURCE_INVALID);
		$file_path = $ressources[$index];
	}

	if (!file_exists($file_path))
		json_puterror(ERR_RESSOURCE_INVALID);

	$ressource = json_decode(file_get_contents($file_path), true);

	if ($request['items']){
		foreach ($request['items'] as $item){
			if (is_numeric($item)){

				$index = $item + 0;
				if (is_array($ressource) && isset($ressource[$index]))
					$ressource = $ressource[$index];
				else
					json_puterror(ERR_RESSOURCE_INVALID);

			} else {

				if (strcmp($item, 'first') == 0 && is_array($ressource)){
					$ressource = $ressource[0];
				} else if (strcmp($item, 'last') == 0 && is_array($ressource)){
					$ressource = $ressource[count($ressource) - 1];
				} else if (is_array($ressource) && array_key_exists($item, $ressource)){
					$ressource = $ressource[$item];
				} else {
					json_puterror(ERR_RESSOURCE_INVALID);
				}

			}
		}
	}

	json_put($ressource);

}