<?php
if (isset($_GET['k']) && file_exists(KEEKO_PATH .'/' . $_GET['k'])) {
	echo file_get_contents(KEEKO_PATH .'/' . $_GET['k']);
	exit;
}

if (isset($_GET['k']) && file_exists(KEEKO_PATH.'/../' . $_GET['k'])) {
	echo file_get_contents(KEEKO_PATH .'/../' . $_GET['k']);
	exit;
}

require_once 'bootstrap.php';
?>