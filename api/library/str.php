<?php

/* Generic string sanitizing, only keeps alpha-numeric and ._- chars */

function str_sanitizestrict($str){
	$str = preg_replace('/\s+/', '_', $str);
	return preg_replace("/[^A-Za-z0-9._-]/", '', $str);
}