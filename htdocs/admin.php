<?php
require_once 'prepend.php';

use net::keeko::cms::apps::Administration;

try {
	$admin = new Administration();
	$admin->run();
} catch(PropelException $e) {
	echo $e->getCause();
}
?>
