<?php

// For debugging
function print_pre($array, $die = false){
	print("<pre>".print_r($array,true)."</pre>");
	if($die === true){
		die();
	}
}

// For debugging
function dump_pre($obj, $die = true){
	print("<pre>".var_dump($obj)."</pre>");
	if($die === true){
		die();
	}
}