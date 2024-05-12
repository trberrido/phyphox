<?php

function json__validate_array($data, $schema){

	$types = [
		'object'	=> 'json__validate',
		'string'	=> 'json__validate_string',
		'number'	=> 'json__validate_number',
		'boolean'	=> 'json__validate_boolean',
		'array'		=> 'json__validate_array',
		'any'		=> 'json__validate_any'
	];

	if (!is_array($data))
		return false;

	if (array_key_exists('items', $schema)){

		$item_type = $schema['items']['type'];

		if (!count($data))
			return (false);

		foreach ($data as $item){

			if (!($types[$item_type])($item, $schema['items']))
				return (false);

		}

	}

	return true;

}