<?php
use Symfony\Component\HttpFoundation\Request;
use keeko\core\application\ApplicationInterface;
use keeko\core\routing\ApplicationRouter;
use keeko\core\routing\RouteMatcherInterface;
use keeko\core\entities\Gateway;
use keeko\core\entities\Application;
use keeko\core\entities\ApplicationQuery;

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


	$router = new ApplicationRouter();

	$uri = $router->match($request);
	$application = $uri->getApplication();

	/* @var $application Application */
	$type = $application->getApplicationType();
	$name = $type->getClassname();

	/* @var $app ApplicationInterface */
	$app = new $name();
	$app->setApplication($application);
	$app->setLocalization($uri->getLocalization());
	$app->run($request, $router);

// 	// get params
// 	$params = $application->getExtraProperties();

// 	/* @var $router RouteMatcherInterface */
// 	$routing = $application->getRouter()->getClassname();
// 	$router = new $routing($params);
// 	$router->match($request);

} catch (\Exception $e) {
	printf('<b>%s</b><pre>%s</pre>', $e->getMessage(), $e->getTraceAsString());
}
