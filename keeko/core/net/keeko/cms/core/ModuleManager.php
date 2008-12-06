<?php
namespace net\keeko\cms\core;/************************************************************************  			core/ModuleManager.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/ModuleManager.php**************************************************************************/
use net\keeko\cms\core\entities\peer\ModulePeer;
class ModuleManager {	/**	 * Contains an array with loaded modules	 * @access private	 */	private $loadedModules = array();
	private $availableModules = array();	public function __construct() {
		$modules = ModulePeer::doSelect(new \Criteria());
		foreach($modules as $module) {
			$this->availableModules[$module->getUnixname()] = $module;
		}
	}
	/**	 * Loads a module. Does checks wether this module can loaded or not.	 *	 * @param string unixname The unixname of the module that should be loaded	 * @return core::AbstractModule	 * @access private	 */	private function loadModule($unixname) {
		$modulePath = sprintf('%s%s/src', KEEKO_PATH_MODULES, $unixname);
		KeekoRuntime::getClasspath()->addPath($modulePath);
		if (!array_key_exists($unixname, $this->availableModules)) {
			throw new KeekoException(sprintf('Module (%s) does not exist', $unixname), 501);
		}
		$entity = $this->availableModules[$unixname];

		$className = sprintf('\\net\\keeko\\cms\\modules\\%s\\%s', $unixname, $unixname);
		$module = new $className($entity);

		if ($module->getAPIVersion() != KEEKO_API) {
			throw new KeekoException(sprintf('API Version Mismatch (%s)', $unixname), 500);
		}

		if ($module->getVersion() > $entity->getVersion()) {
			throw new KeekoException(sprintf('Module Version Mismatch (%s). Module needs updated by the Administrator', $unixname), 500);
		}

		$this->loadedModules[$unixname] = $module;	}	/**	 *	 * @param string unixname The module's unixname	 * @return core::AbstractModule	 * @access public	 */	public function getModule($unixname) {		if (!array_key_exists($unixname, $this->loadedModules)) {
			$this->loadModule($unixname);
		}

		return $this->loadedModules[$unixname];	}	/**	 * Returns wether this module is loaded or not	 *	 * @param string unixname The module's unixname	 * @return bool	 * @access public	 */	public function isLoaded($unixname) {		return array_key_exists($unixname, $this->loadedModules);	}} // end of ModuleManager?>