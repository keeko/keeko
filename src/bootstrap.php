<?php
use keeko\core\config\DatabaseConfiguration;
use Symfony\Component\Config\FileLocator;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;
use Propel\Runtime\Connection\PropelPDO;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

define('KEEKO_PRODUCTION', 'production');
define('KEEKO_DEVELOPMENT', 'development');
defined('KEEKO_PATH') or define('KEEKO_PATH', dirname(__DIR__));
defined('KEEKO_PATH_CONFIG') or define('KEEKO_PATH_CONFIG', KEEKO_PATH . DIRECTORY_SEPARATOR . 'config');
defined('KEEKO_PATH_MODULES') or define('KEEKO_PATH_MODULES', KEEKO_PATH . DIRECTORY_SEPARATOR . 'modules');
defined('KEEKO_PATH_APPS') or define('KEEKO_PATH_APPS', KEEKO_PATH . DIRECTORY_SEPARATOR . 'apps');
defined('KEEKO_PATH_DESIGNS') or define('KEEKO_PATH_DESIGNS', KEEKO_PATH . DIRECTORY_SEPARATOR . 'designs');
defined('KEEKO_PATH_FILES') or define('KEEKO_PATH_FILES', KEEKO_PATH . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'files');
defined('KEEKO_ENVIRONMENT') or define('KEEKO_ENVIRONMENT', KEEKO_DEVELOPMENT);

if (KEEKO_ENVIRONMENT == KEEKO_DEVELOPMENT) {
	error_reporting(E_ALL | E_STRICT);
}

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
	'password' => $databaseConfiguration->getPassword()
]);
$manager->setName('keeko');
$serviceContainer->setConnectionManager('keeko', $manager);
$serviceContainer->setDefaultDatasource('keeko');

if (KEEKO_ENVIRONMENT == KEEKO_DEVELOPMENT) {
	$con = Propel::getWriteConnection('keeko');
	$con->useDebug(true);
	$logger = new Logger('defaultLogger');
	$logger->pushHandler(new StreamHandler('php://stderr'));
	Propel::getServiceContainer()->setLogger('defaultLogger', $logger);
}

unset($databaseConfiguration);
