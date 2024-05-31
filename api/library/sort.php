<?php

/* sort most recent first */

function sort__time(&$array){
	usort($array, function( $a, $b ) { return filemtime($b) - filemtime($a); } );
}