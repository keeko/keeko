<?php
use keeko\core\installer\KeekoInstaller;

require_once '../src/bootstrap.php';

$installer = new KeekoInstaller();
$installer->install();

$installer->installModule('gossi/trixionary');
$installer->activateModule('gossi/trixionary');

$installer->installModule('gossi/trixionary-client');
$installer->activateModule('gossi/trixionary-client');

$app = $installer->installApp('gossi/trixionary-app');
$installer->setAppUrl($app, '/trixionary/');

echo 'done';