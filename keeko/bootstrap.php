<?php
error_reporting(E_ALL);
set_include_path('../libs' . PATH_SEPARATOR . get_include_path());

require_once 'version.php';
require_once 'config.php';
require_once 'functions.php';
require_once 'Classpath.php';
require_once 'propel/Propel.php';

defined('KEEKO_PATH') or define('KEEKO_PATH', dirname(__FILE__) . '/');
defined('KEEKO_ENVIRONMENT') or define('KEEKO_ENVIRONMENT', 'development');

$classpath = new Classpath();
$classpath->addPath(KEEKO_PATH);
spl_autoload_register(array($classpath, 'load'));

Propel::init(KEEKO_PATH . '/keeko-conf.php');
net::keeko::cms::core::KeekoRuntime::setClasspath($classpath);

unset($dbHost);
unset($dbName);
unset($dbUser);
unset($dbPass);
unset($classpath);
?>