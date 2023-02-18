<?php

function validate_array($data, $schema){
	
	$types = [
		'object'	=> 'json_validate',
		'string'	=> 'validate_string',
		'number'	=> 'validate_number',
		'boolean'	=> 'validate_boolean',
		'array'		=> 'validate_array',
		'any'		=> 'validate_any'
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