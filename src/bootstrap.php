<?php
use keeko\config\DatabaseConfiguration;

use Symfony\Component\Config\FileLocator;

define('KEEKO_PRODUCTION', 'production');
define('KEEKO_DEVELOPMENT', 'development');
defined('KEEKO_PATH') or define('KEEKO_PATH', dirname(__DIR__));
defined('KEEKO_PATH_CONFIG') or define('KEEKO_PATH_CONFIG', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config');
defined('KEEKO_PATH_MODULES') or define('KEEKO_PATH_MODULES', KEEKO_PATH . DIRECTORY_SEPARATOR . 'modules');
defined('KEEKO_PATH_APPS') or define('KEEKO_PATH_APPS', KEEKO_PATH . DIRECTORY_SEPARATOR . 'apps');
defined('KEEKO_ENVIRONMENT') or define('KEEKO_ENVIRONMENT', KEEKO_PRODUCTION);

if (KEEKO_ENVIRONMENT == KEEKO_DEVELOPMENT) {
	error_reporting(E_ALL | E_STRICT);
}

require 'version.php';

/* @var $loader \Composer\Autoload\ClassLoader */
$loader = require '../vendor/autoload.php';

// load database config
$locator = new FileLocator(KEEKO_PATH_CONFIG);
$dbConfig = $locator->locate('database.yml', null, true);

$databaseConfiguration = new DatabaseConfiguration($locator);
$databaseConfiguration->load($dbConfig);

// propel database configuration
$propelConf = array (
	'datasources' => array (
		'keeko' => array (
			'adapter' => 'mysql',
			'connection' => array (
				'dsn' => 'mysql:host=' . $databaseConfiguration->getHost() . ';dbname=' . $databaseConfiguration->getDatabase(),
				'user' => $databaseConfiguration->getUser(),
				'password' => $databaseConfiguration->getPassword(),
				'settings' => array (
					'charset' => array (
						'value' => 'utf8',
					),
				),
			),
		),
		'default' => 'keeko',
	),
	'generator_version' => '1.6.7',
);

// propel boot
Propel::setConfiguration($propelConf);
Propel::initialize();

unset($databaseConfiguration);
unset($propelConf);

