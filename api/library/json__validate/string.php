<?php

function json__validate_string($data, $schema){

	$formats = [
		'email' => function ($str) {
			return !(filter_var($str, FILTER_VALIDATE_EMAIL) == false);
		}
	];

	$options = [
		'minLength' => function ($str, $len) { return (strlen($str) >= $len); },
		'maxLength' => function ($str, $len) { return (strlen($str) <= $len); },
		'pattern'	=> function ($str, $pattern) {
			return !(filter_var($str, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $pattern ]]) === false);
		}
	];

	if (array_key_exists('format', $schema) && array_key_exists($schema['format'], $formats)){
		if (!($formats[$schema['format']])($data))
			return false;
	}

	foreach($schema as $schema_property_key => $schema_property_value){
		if (array_key_exists($schema_property_key, $options)){
			if (!($options[$schema_property_key])($data, $schema_property_value))
				return false;
		}
	}

	return is_string($data);

}