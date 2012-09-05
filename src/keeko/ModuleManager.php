<?php
namespace keeko;

use Symfony\Component\Finder\Finder;

use keeko\ModuleDescriptor;

use keeko\exceptions\ModuleException;

use Composer\Autoload\ClassLoader;

use keeko\entities\ModuleQuery;

class ModuleManager {

	private $loadedModules = array();
	private $availableModules = array();
	private $installedModules = null;
	private $descriptors = array();
	private $classLoader;

	public function __construct(ClassLoader $classLoader) {
		$this->classLoader = $classLoader;

		$finder = new Finder();
		$result = $finder->directories()->in(KEEKO_PATH_MODULES)->ignoreDotFiles(true);

		foreach ($result as $unixname) {
			$this->availableModules []= $unixname->getFilename();
		}
	}

	public function getInstalledModules() {
		if (is_null($this->installedModules)) {
			$this->installedModules = array();
			$modules = ModuleQuery::create()->find();
			foreach ($modules as $module) {
				$this->installedModules[$module->getUnixname()] = $module;
			}
		}
		return $this->installedModules;
	}

	/**
	 *
	 * @param unknown $unixname
	 * @throws ModuleException
	 * @return ModuleDescriptor
	 */
	public function getModuleDescriptor($unixname) {
		if (!array_key_exists($unixname, $this->descriptors)) {
			if (!in_array($unixname, $this->availableModules)) {
				throw new ModuleException(sprintf('Module (%s) does not exist', $unixname), 501);
			}
			$this->descriptors[$unixname] = new ModuleDescriptor($unixname);
		}

		return $this->descriptors[$unixname];
	}

	public function load($unixname) {
		// check installetion
		if (!array_key_exists($unixname, $this->getInstalledModules())) {
			throw new ModuleException(sprintf('Module (%s) not installed', $unixname), 501);
		}


		// check environment
		$descriptor = $this->getModuleDescriptor($unixname);
		if ($descriptor->getApiVersion() != KEEKO_API) {
			throw new ModuleException(sprintf('API Version Mismatch (%s)', $unixname), 500);
		}

		$module = $descriptor->getModule();
		$descriptor->setModule($this->installedModules[$unixname]);

		if ($descriptor->getVersion() > $module->getVersion()) {
			throw new ModuleException(sprintf('Module Version Mismatch (%s). Module needs updated by the Administrator', $unixname), 500);
		}

		// load
		$className = $module->getClassname();
		$namespace = implode('\\', array_slice(explode('\\', $module->getClassname()), 0, -1));

		$this->classLoader->add($namespace, $descriptor->getDirectory() . 'src');
		$this->loadedModules []= $unixname;
	}

	/**
	 * Returns wether a module was loaded
	 *
	 * @param String $unixname
	 * @return boolean true if loaded, false if not
	 */
	public function isLoaded($unixname) {
		return in_array($unixname, $this->loadedModules);
	}
}
