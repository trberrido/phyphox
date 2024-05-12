<?php

/*
	json_ functions
*/

function json__check_input($input) {
	json_decode($input);
	return json_last_error() === JSON_ERROR_NONE;
}

/* json validation with schema json file */

foreach (glob('library/json__validate/*.php') as $php_file)
	include_once $php_file;

function json__validate($data, $schema){

	// the below functions are in ./json__validate
	$types = [
		'object'	=> 'json__validate',
		'string'	=> 'json__validate_string',
		'number'	=> 'json__validate_number',
		'boolean'	=> 'json__validate_boolean',
		'array'		=> 'json__validate_array',
		'any'		=> 'json__validate_any'
	];

	// check if required properties are present in data
	if (array_key_exists('required', $schema)){
		foreach ($schema['required'] as $requirement){
			if (!array_key_exists($requirement, $data))
				return false;
		}
	}

	// check if data
	//		- is present in the schema
	//		- applies to the indicated type in schema
	foreach ($data as $key => $value){
		if (!array_key_exists($key, $schema['properties']))
			continue ;
		$property_type = $schema['properties'][$key]['type'];
		if (!($types[$property_type])($value, $schema['properties'][$key]))
			return false;
	}

	return true;

}

function json__put($content = true){
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($content);
	exit();
}

function json__puterror($content = false){
	json__put(['error' => $content]);
}