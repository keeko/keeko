<?php
function redirect ($location) {
	$uri = $_SERVER['HTTP_HOST'];
	if (!strstr($location, dirname($_SERVER['PHP_SELF']))) {
		$uri .= dirname($_SERVER['PHP_SELF']);
	}
	$uri = str_replace('//', '/', $uri . '/' . $location);

	header('location: http://' . $uri);
	exit;
}

function xmlentities($string) {
	$search = array('<', '>', '&', '\'', '"');
	$replace = array('&lt;', '&gt;', '&amp;', '&apos;', '&quot;');
	
	return str_replace($search, $replace, $string);
}
?>