<?php

/* sort most recent first */

function sort_time(&$array){
	usort($array, function( $a, $b ) { return filemtime($b) - filemtime($a); } );
}