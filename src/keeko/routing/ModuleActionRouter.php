<?php
namespace keeko\routing;

use Symfony\Component\Routing\Generator\UrlGenerator;

use Symfony\Component\Routing\Matcher\UrlMatcher;

use Symfony\Component\Routing\RequestContext;

use Symfony\Component\Routing\Route;

use Symfony\Component\Routing\RouteCollection;

class ModuleActionRouter {

	private $generator;
	private $matcher;

	public function __construct($defaultModule, $baseUrl = '') {
		$routes = new RouteCollection();

		$moduleRoute = new Route('/{module}', array('module' => $defaultModule));
		$actionRoute = new Route('/{module}/{action}');
		$paramsRoute = new Route('/{module}/{action}/{params}');

		$routes->add('module', $moduleRoute);
		$routes->add('action', $actionRoute);
		$routes->add('params', $paramsRoute);

		$context = new RequestContext($baseUrl);

		$this->matcher = new UrlMatcher($routes, $context);
		$this->generator = new UrlGenerator($routes, $context);
	}

	public function match($destination) {
		if ($destination == '') {
			$destination = '/';
		}

		$data = $this->matcher->match($destination);

		// polish params
		if (array_key_exists('params', $data)) {
			$parts = explode(';', $data['params']);
			$params = array();
			foreach ($parts as $part) {
				$kv = explode('=', $part);
				if ($kv[0] != '') {
					$params[$kv[0]] = count($kv) > 1
						? $kv[1] == 'on' ? true : ($kv[1] == 'off' ? false : $kv[1])
						: true;
				}
			}
			$data['params'] = $params;
		}

		return $data;
	}

	public function generate($data) {

		// params route
		if (array_key_exists('params', $data)) {

			// stringify params
			$params = '';
			foreach ($data['params'] as $key => $val) {
				$params .= $key;
				if (is_bool($val) === true) {
					$params .= '=' . $val ? 'on' : 'off';
				} else if ($val != '') {
					$params .= '=' . $val;
				}
				$params .= ';';
			}
			$data['params'] = $data;
			return $this->generator->generate('params', $data);
		}

		// action route
		if (array_key_exists('action', $data)) {
			return $this->generator->generate('action', $data);
		}

		// module route
		if (array_key_exists('module', $data)) {
			return $this->generator->generate('module', $data);
		}
	}
}
