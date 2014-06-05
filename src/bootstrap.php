<?php
use keeko\core\config\DatabaseConfiguration;
use Symfony\Component\Config\FileLocator;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;

define('KEEKO_PRODUCTION', 'production');
define('KEEKO_DEVELOPMENT', 'development');
defined('KEEKO_PATH') or define('KEEKO_PATH', dirname(__DIR__));
defined('KEEKO_PATH_CONFIG') or define('KEEKO_PATH_CONFIG', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config');
defined('KEEKO_PATH_MODULES') or define('KEEKO_PATH_MODULES', KEEKO_PATH . DIRECTORY_SEPARATOR . 'modules');
defined('KEEKO_PATH_APPS') or define('KEEKO_PATH_APPS', KEEKO_PATH . DIRECTORY_SEPARATOR . 'apps');
defined('KEEKO_PATH_DESIGNS') or define('KEEKO_PATH_DESIGNS', KEEKO_PATH . DIRECTORY_SEPARATOR . 'designs');
defined('KEEKO_ENVIRONMENT') or define('KEEKO_ENVIRONMENT', KEEKO_PRODUCTION);

if (KEEKO_ENVIRONMENT == KEEKO_DEVELOPMENT) {
	error_reporting(E_ALL | E_STRICT);
}

// /* @var $loader \Composer\Autoload\ClassLoader */
require KEEKO_PATH . '/vendor/autoload.php';

// load database config
$locator = new FileLocator(KEEKO_PATH_CONFIG);
$dbConfig = $locator->locate('database.yml', null, true);

$databaseConfiguration = new DatabaseConfiguration($locator);
$databaseConfiguration->load($dbConfig);

// propel 2
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass('keeko', 'mysql');
$manager = new ConnectionManagerSingle();
$manager->setConfiguration([
	'dsn'      => 'mysql:host=' . $databaseConfiguration->getHost() . ';dbname=' . $databaseConfiguration->getDatabase(),
	'user'     => $databaseConfiguration->getUser(),
	'password' => $databaseConfiguration->getPassword(),
	'settings' => [
		'charset' => 'utf8'
	]
]);
$manager->setName('keeko');
$serviceContainer->setConnectionManager('keeko', $manager);
$serviceContainer->setDefaultDatasource('keeko');

unset($databaseConfiguration);


