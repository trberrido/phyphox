<?php

/* Generic string sanitizing, only keeps alpha-numeric and ._- chars */

function str__sanitize_strict($str){
	$str = preg_replace('/\s+/', '_', $str);
	return preg_replace("/[^A-Za-z0-9._-]/", '', $str);
}