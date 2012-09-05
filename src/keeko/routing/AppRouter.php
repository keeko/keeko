<?php
namespace keeko\routing;

use keeko\model\AppUri;

use keeko\exceptions\AppException;

use keeko\model\AppUriQuery;

use Symfony\Component\HttpFoundation\Request;

class AppRouter {

	private $destination;
	private $prefix;

	public function __construct() {
	}

	public function getDestination() {
		return $this->destination;
	}

	public function getPrefix() {
		return $this->prefix;
	}

	/**
	 *
	 *
	 * @param Request $request
	 * @throws AppException
	 * @return AppUri
	 */
	public function match(Request $request) {
		$uri = null;
		// better loop. Maybe some priority on longer strings?
		// Or strings with more slashes?
		// better query on that?
		$uris = AppUriQuery::create()
			->joinApp()
			->filterByHttphost($request->getHttpHost())
			->find();

		foreach ($uris as $uri) {
			if ($pos = strpos($request->getRequestUri(), $uri->getBasepath()) !== false) {
				$this->destination = substr($request->getRequestUri(), strlen($uri->getBasepath()));
				$this->prefix = str_replace($request->getBasePath(), '', $uri->getBasePath());
				break;
			}
		}

		if (is_null($uri)) {
			throw new AppException(sprintf('No app found on %s', $request->getUri()), 404);
		}

		return $uri;
	}
}
