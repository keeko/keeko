<?php
if (file_exists(dirname(__FILE__) . '/dev.php')) {
	require_once 'dev.php';
}

require_once 'version.php';
require_once 'config.php';
require_once 'functions.php';

defined('KEEKO_PATH') or define('KEEKO_PATH', dirname(__FILE__) . '/');
defined('KEEKO_PATH_CORE') or define('KEEKO_PATH_CORE', KEEKO_PATH . 'core/');
defined('KEEKO_PATH_MODULES') or define('KEEKO_PATH_MODULES', KEEKO_PATH . 'modules/');
defined('KEEKO_PATH_APPS') or define('KEEKO_PATH_APPS', KEEKO_PATH . 'apps/');
defined('KEEKO_PATH_LIBS') or define('KEEKO_PATH_LIBS', KEEKO_PATH . 'libs/');
defined('KEEKO_ENVIRONMENT') or define('KEEKO_ENVIRONMENT', 'production');

// redirect file requests
if (isset($_GET['k'])) {
	if (stristr($_GET['k'], 'libs/')) {
		$path = substr(stristr($_GET['k'], '/'), 1);

		if (file_exists(KEEKO_PATH_LIBS . $path)) {
			sendFile(KEEKO_PATH_LIBS . $path);
		}
	}

	if (stristr($_GET['k'], 'modules/')) {
		$path = substr(stristr($_GET['k'], 'modules/'), 1);

		if (file_exists(KEEKO_PATH_MODULES . $path)) {
			sendFile(KEEKO_PATH_MODULES . $path);
		}
	}
}


if (KEEKO_ENVIRONMENT == 'development') {
	error_reporting(E_ALL);
}

set_include_path(KEEKO_PATH_LIBS . PATH_SEPARATOR . get_include_path());

require_once 'Classpath.php';
require_once 'propel/Propel.php';

$classpath = new Classpath();
$classpath->addPath(KEEKO_PATH_CORE);
spl_autoload_register(array($classpath, 'load'));

Propel::init(KEEKO_PATH . '/propel-conf.php');
net\keeko\cms\core\KeekoRuntime::setClasspath($classpath);

unset($dbHost);
unset($dbName);
unset($dbUser);
unset($dbPass);
unset($classpath);
?>