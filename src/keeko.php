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
	$model = $uri->getApplication();
	$destination = str_replace($router->getDestination(), '', $request->getUri());
	$root = str_replace($router->getPrefix(), '', $destination);

	$class = $model->getClassName();
	$app = new $class($model);
	$app->setLocalization($uri->getLocalization());
	$app->setPrefix($router->getPrefix());
	$app->setDestination($destination);
	$app->setRoot($root);

	$response = $app->run($request, $router->getDestination());
	$response->prepare($request);
	$response->send();

} catch (\Exception $e) {
	printf('<b>[%s] %s</b><pre>%s</pre>', get_class($e), $e->getMessage(), $e->getTraceAsString());
}
