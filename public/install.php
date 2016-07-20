<?php
use keeko\framework\kernel\InstallerKernel;
use keeko\keeko\WebIO;
use Symfony\Component\HttpFoundation\Request;
use keeko\framework\installer\KeekoInstaller;
use keeko\framework\service\ServiceContainer;

require_once __DIR__ . '/../vendor/autoload.php';
$puli = require_once __DIR__ . '/../packages/keeko/framework/bootstrap/bootstrap.php';

$request = Request::createFromGlobals();
$rootUrl = sprintf('%s://%s%s',
		$request->getScheme(),
		$request->getHttpHost(),
		$request->getBasePath());

$installer = new KeekoInstaller(new ServiceContainer($puli), new WebIO());
$installer->install($rootUrl);

echo 'done';