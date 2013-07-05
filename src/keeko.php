<?php
use Symfony\Component\HttpFoundation\Request;
use keeko\core\application\ApplicationInterface;
use keeko\core\routing\ApplicationRouter;
use keeko\core\routing\RouteMatcherInterface;
use keeko\core\entities\Gateway;
use keeko\core\entities\Application;

require 'bootstrap.php';

try {

	// Test the request
	$request = Request::createFromGlobals();

// 	printf('<p>Basepath: %s<br>
// 			Pathinfo: %s<br>
// 			Baseurl: %s<br>
// 			Host: %s<br>
// 			HttpHost: %s<br>
// 			Requsturi: %s<br>
// 			Uri: %s<br>
// 			Port: %s<br>
// 			Secure: %s</p>',
// 			$request->getBasePath(),
// 			$request->getPathInfo(),
// 			$request->getBaseUrl(),
// 			$request->getHost(),
// 			$request->getHttpHost(),
// 			$request->getRequestUri(),
// 			$request->getUri(),
// 			$request->getPort(),
// 			$request->isSecure() ? 'yes' : 'no');


// 	$gateway = new ApplicationGateway();
// 	$dest = $gateway->find($request);
// 	$gateway->run($dest, $request);

	$router = new ApplicationRouter();

	$uri = $router->match($request);
	$gateway = $uri->getGateway();

	/* @var $router RouteMatcherInterface */
	$routing = $gateway->getRouter()->getClassname();
	$router = new $routing();

	/* @var $application Application */
	$application = $gateway->getApplication();
	$name = $application->getName();

	/* @var $app ApplicationInterface */
	$app = new $name();
	$app->setLocalization($uri->getLocalization());

	// get params
	$defaults = [];
	$params = $app::getParams();

	foreach ($params as $param) {
		if ($gateway->hasProperty($param)) {
			$defaults[$param] = $gateway->getProperty($param);
		}
	}

} catch (\Exception $e) {

}
