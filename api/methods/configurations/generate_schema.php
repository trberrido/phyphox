<?php

/*
	POST | PUT configurations
		generate schema file
		that will be used to filtered inputs sent by phyphox app
*/

$schemapath = DATA_PUBLIC_DIR . '/schemas/input.json';
if (file_exists($schemapath))
	unlink($schemapath);

$schema = [
	'$schema' 		=> 'https://json-schema.org/draft/2020-12/schema',
	'$id'			=> $schemapath,
	'type'			=> 'object',
	'properties'	=> []
];

// if duplication (rather than creating new content),
// open the original file to generate the schema
if ($request['ressource'] && !$request['data']){
	$filepath = DATA_PUBLIC_DIR . '/' .  $request['collection'] . '/' . $request['ressource'];
	if (!file_exists($filepath))
		json__puterror(ERR_RESSOURCE_INVALID);

	$content = json_decode(file_get_contents($filepath), true);
	$visualizations = $content['visualizations'];

} else {

	// else, (creating new content)
	// get content from POST data
	$visualizations = $request['data']['visualizations'];

}


foreach ($visualizations as $visualization){

	if (!empty($visualization['pythonfile']['extravariables'])){
		foreach($visualization['pythonfile']['extravariables'] as $extravariable){
			$property =  [
				'type'	=> 'array',
				'items'	=> [ 'type' => 'number' ]
			];
			$schema['properties'][$extravariable] = $property;
		}
	}

	if (strcmp($visualization['type'], 'Single Number') == 0){
		$property =  [
				'type'	=> 'array',
				'items'	=> [ 'type' => 'number' ]
			];
		$schema['properties'][$visualization['id']] = $property;
//-		$schema['required'] = $visualization['id'];
	}

	if (strcmp($visualization['type'], 'Histogram') == 0){
		$property = [
			'type'	=> 'array',
			'items'	=> [ 'type' => 'number' ]
		];
		$schema['properties'][$visualization['id']] = $property;
//		$schema['required'] = $visualization['id'];
	}

	if (strcmp($visualization['type'], 'Graph') == 0){
		$property_x = [
			'type'	=> 'array',
			'items'	=> [ 'type' => 'number']
		];
		$schema['properties'][$visualization['idx']] = $property_x;
		$property_y = [
			'type'	=> 'array',
			'items'	=> [ 'type' => 'number']
		];
		$schema['properties'][$visualization['idy']] = $property_y;
//		$schema['required'] = [$visualization['idy'], $visualization['idx']];
	}

}

file_put_contents($schemapath, json_encode($schema));