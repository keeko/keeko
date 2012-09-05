<?php
use keeko\AppManager;
use Symfony\Component\HttpFoundation\Request;

require 'bootstrap.php';

// Test the request
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


try {
	$manager = new AppManager($loader);
	$app = $manager->find($request);

	// load app
	$manager->load($app);

	// init app
	$keekoApp = $manager->init($app);
	$keekoApp->run();
} catch (AppException $e) {

}
