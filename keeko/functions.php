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

function sendFile($path) {
	/*if (!function_exists('mime_content_type')) {
		$finfo = new finfo(FILEINFO_MIME);
		$mimetype = $finfo->file(getcwd() . '/'.$path);
	} else {
		$mimetype = mime_content_type(getcwd() . '/'.$path);
	}*/
	$mimetype = apacheMimetype(getcwd() . '/'.$path);

	header("Content-type: $mimetype");
	//header("Content-Disposition: attachment; filename=".basename($path)."");
	$ext = array_pop(explode('.',$path));
	if ($ext == 'php') {
		$contents = file_get_contents($path);
		$contents = str_replace('<?php', "", $contents);
		$contents = str_replace('<?', "", $contents);   // Make sure to get rid of short tags....
		$contents = str_replace('?>', "", $contents);
		eval($contents);
	} else {
		echo file_get_contents($path);
	}
	exit;
}

function apacheMimetype($file) {
	$ext = array_pop(explode('.',$file));
	foreach(file(dirname(__FILE__).'/mime.types') as $line)
		if(preg_match('/^([^#]\S+)\s+.*'.$ext.'.*$/', $line, $m))
			return $m[1];
	return 'application/octet-stream';
}
?>