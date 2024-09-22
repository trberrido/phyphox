<?php

function json__check_input(mixed $input):bool {
	@json_decode($input);
	return json_last_error() === JSON_ERROR_NONE;
}

/* loading function used by json__validate */

foreach (glob('library/json__validate/*.php') as $php_file)
	include_once $php_file;

function json__validate(mixed $data, array $schema):bool {

	// the below functions are in ./json__validate
	$types = [
		'object'	=> 'json__validate',
		'string'	=> 'json__validate_string',
		'number'	=> 'json__validate_number',
		'boolean'	=> 'json__validate_boolean',
		'array'		=> 'json__validate_array',
		'any'		=> 'json__validate_any'
	];

	if (array_key_exists('required', $schema)){
		foreach ($schema['required'] as $requirement){
			if (!array_key_exists($requirement, $data))
				return false;
		}
	}

	foreach ($data as $key => $value){
		if (!array_key_exists($key, $schema['properties']))
			continue ;
		$property_type = $schema['properties'][$key]['type'];
		if (!($types[$property_type])($value, $schema['properties'][$key]))
			return false;
	}

	return true;

}

function json__create_from_schema(string $schema_path, string $json_file):bool {

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

/* the json__put signs the end of the program */

function json__put(mixed $content = true):void {
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($content, JSON_PRETTY_PRINT);
	exit();
}

function json__puterror(mixed $error = true):void {
	json__put(['error' => $error]);
}