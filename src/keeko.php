<?php
use Symfony\Component\HttpFoundation\Request;
use keeko\core\application\Keeko;
use keeko\core\routing\ApplicationRouter;

require 'bootstrap.php';

try {
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

	$keeko = new Keeko();
	$keeko->setEntity($application);
	$keeko->setLocalization($uri->getLocalization());

	$response = $keeko->run($request, $router);
	$response->prepare($request);
	$response->send();

} catch (\Exception $e) {
	printf('<b>%s</b><pre>%s</pre>', $e->getMessage(), $e->getTraceAsString());
}
