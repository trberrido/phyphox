<?php

/*
	json_ functions
*/

function json__check_input($input) {
	@json_decode($input);
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

/* create json from schema */

function json__create_from_schema($schema_path, $json_file){

	$content = file_get_contents($schema_path);
	if (!$content)
		return false;
	$schema = json_decode($content, true);

	$object = [];
	$types_default_value_match = [
		'object'	=> null,
		'string'	=> '',
		'number'	=> 0,
		'boolean'	=> false,
		'array'		=> []
	];

	foreach ($schema['properties'] as $property => $values){
		if (array_key_exists('type', $values))
			$object[$property] = $types_default_value_match[$values['type']];
		else
			$object[$property] = null;
	}

	if (!file_put_contents($json_file, json_encode($object)))
		return false;

	return true;

}

/* output functions */

function json__put($content = true){
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($content);
	exit();
}

function json__puterror($error = true){
	json__put(['error' => $error]);
}