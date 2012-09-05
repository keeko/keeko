<?php
namespace keeko;

use keeko\routing\AppRouter;

use keeko\exceptions\AppException;

use Composer\Autoload\ClassLoader;

use keeko\entities\App;

use keeko\entities\AppQuery;

use Symfony\Component\HttpFoundation\Request;

class AppManager {

	/* @var App[] */
	private $installedApps = array();

	private $loadedApps = array();

	private $loader;

	private $router;

	public function __construct(ClassLoader $loader) {
		$this->loader = $loader;
		$this->router = new AppRouter();

		// load apps
		$apps = AppQuery::create()->find();

		foreach ($apps as $app) {
			$this->installedApps[$app->getUnixname()] = $app;
		}
	}

	/**
	 *
	 * @param string|App $app Unixname as string or App modle
	 * @return boolean
	 */
	public function exists($app) {
		if ($app instanceof App) {
			$app = $app->getUnixname();
		}
		return file_exists(KEEKO_PATH_APPS . DIRECTORY_SEPARATOR . $app);
	}

	/**
	 *
	 * @param string|App $app Unixname as string or App modle
	 * @return boolean
	 */
	public function installed($app) {
		if ($app instanceof App) {
			$app = $app->getUnixname();
		}
		return array_key_exists($app, $this->installedApps);
	}

	/**
	 *
	 * @param App $app
	 * @return boolean
	 */
	public function loaded(App $app) {
		return in_array($app, $this->loadedApps);
	}

	/**
	 * Loads an app
	 *
	 * @param App $app
	 * @throws AppException
	 */
	public function load(App $app) {
		if ($this->loaded($app)) {
			return;
		}

		if (!$this->exists($app)) {
			throw new AppException(sprintf('App (%s) does not exist in the filesystem', $app->getName()), 501);
		}

		if (!$this->installed($app)) {
			throw new AppException(sprintf('App (%s) is not installed', $app->getName()), 501);
		}
		$namespace = implode('\\', array_slice(explode('\\', $app->getClassname()), 0, -1));

		$this->loader->add($namespace, KEEKO_PATH_APPS. DIRECTORY_SEPARATOR . $app->getUnixname() . DIRECTORY_SEPARATOR . 'src');
		$this->loadedApps []= $app;
	}

	/**
	 * Loads (if not already done) and inits the passed app
	 *
	 * @param App $app
	 * @throws AppException
	 * @return KeekoApp
	 */
	public function init(App $app) {
		if (!$this->loaded($app)) {
			$this->load($app);
		}
		$className = $app->getClassname();
		return new $className($app, $this->router, $this->loader);
	}

	/**
	 *
	 * @param Request $request
	 * @return App
	 */
	public function find(Request $request) {
		$uri = $this->router->match($request);
		$app = $uri->getApp();
		return $app;
	}
}
