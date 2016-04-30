<?php
use keeko\framework\kernel\InstallerKernel;
use keeko\keeko\WebIO;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__DIR__) . '/src/bootstrap.php';

$request = Request::createFromGlobals();

// printf('<p>Basepath: %s<br>
// 		Pathinfo: %s<br>
// 		Baseurl: %s<br>
// 		Host: %s<br>
// 		HttpHost: %s<br>
// 		Requsturi: %s<br>
// 		Uri: %s<br>
// 		Port: %s<br>
// 		Secure: %s</p>',
// 		$request->getBasePath(),
// 		$request->getPathInfo(),
// 		$request->getBaseUrl(),
// 		$request->getHost(),
// 		$request->getHttpHost(),
// 		$request->getRequestUri(),
// 		$request->getUri(),
// 		$request->getPort(),
// 		$request->isSecure() ? 'yes' : 'no');

$rootUrl = sprintf('%s://%s%s', 
		$request->getScheme(),
		$request->getHttpHost(),
		$request->getBasePath());

try {
	$kernel = new InstallerKernel();
	$kernel->process([
		'io' => new WebIO(),
		'uri' => $rootUrl
	]);
} catch (Exception $e) {
	printf('<pre>[%s] <b>%s</b> in <br>%s:%s<br>%s</pre>', 
			get_class($e),
			$e->getMessage(),
			$e->getFile(),
			$e->getLine(),
			$e->getTraceAsString());
}

// $installer->installModule('gossi/trixionary');
// $installer->activateModule('gossi/trixionary');

// $installer->installModule('gossi/trixionary-client');
// $installer->activateModule('gossi/trixionary-client');

// $app = $installer->installApp('gossi/trixionary-app');
// $installer->setAppUrl($app, '/trixionary/');

echo 'done';