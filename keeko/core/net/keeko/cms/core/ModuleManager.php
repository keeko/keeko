<?php
namespace net::keeko::cms::core;
use net::keeko::cms::core::entities::ModulePeer;

	private $availableModules = array();
		$modules = ModulePeer::doSelect(new ::Criteria());
		foreach($modules as $module) {
			$this->availableModules[$module->getUnixname()] = $module;
		}
	}

		if (!array_key_exists($unixname, $this->availableModules)) {
			throw new KeekoException(sprintf('Module (%s) does not exist', $unixname), 501);
		}
		$entity = $this->availableModules[$unixname];

		$className = sprintf('net::keeko::cms::modules::%s::%s', $unixname, $unixname);
//		$moduleFile = sprintf('modules/%s/%s.php', $unixname, $unixname);
//		if (!file_exists($moduleFile)) {
//			throw new KeekoException(sprintf('Module Class not available (%s)', $unixname, 500));
//		}
//		require_once $moduleFile;

		$module = new $className($entity);

		if ($module->getAPIVersion() != KEEKO_API) {
			throw new KeekoException(sprintf('API Version Mismatch (%s)', $unixname), 500);
		}

		if ($module->getVersion() > $entity->getVersion()) {
			throw new KeekoException(sprintf('Module Version Mismatch (%s). Module needs updated by the Administrator', $unixname), 500);
		}

		$this->loadedModules[$unixname] = $module;
			$this->loadModule($unixname);
		}
		
		return $this->loadedModules[$unixname];