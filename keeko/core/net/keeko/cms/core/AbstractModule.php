<?php
namespace net::keeko::cms::core;/************************************************************************  			core/AbstractModule.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/AbstractModule.php**************************************************************************/
use net::keeko::cms::core::entities::Module;
/** * class AbstractModule * Abstract handler for modules. Used for basic initialisation such as loading the * configuration. */abstract class AbstractModule {
	/**	 * Contains the configuration for this module	 * @access protected	 */	protected $config;

	private $info = array();

	private $actions = array();

	private $i18nActions = array();

	private $manifest = null;

	private $entity = null;	public function __construct(Module $entity) {
		$this->entity = $entity;
		$unixname = $this->entity->getUnixname();
		$design = KeekoRuntime::getInstance()->getConfig()->get('design');

		// read manifest
		$this->manifest = new DOMDocument('1.0');
		$this->manifest->load(sprintf('net/keeko/cms/modules/%s/manifest.xml', $unixname));

		// general info part
		$generalNodeList = $this->manifest->getElementsByTagName('general');
		$generalList = $generalNodeList->item(0)->childNodes;

		for ($i = 0; $i < $generalList->length; $i++) {
			$node = $generalList->item($i);
			$this->info[$node->nodeName] = $node->nodeValue;
		}

		// actions
		$actionList = $this->manifest->getElementsByTagName('action');

		for ($i = 0; $i < $actionList->length; $i++) {
			$d = new ActionDescriptor();
			$node = $actionList->item($i);
			$name = $node->attributes->getNamedItem('name')->nodeValue;
			$className = $node->attributes->getNamedItem('className')->nodeValue;
			$d->setClassName($className);

			$childs = $node->childNodes;
			for ($j = 0; $j < $childs->length; $j++) {
				$child = $childs->item($j);
				switch ($child->nodeName) {
					case 'css':
						$file = $child->attributes->getNamedItem('file')->nodeValue;
						$file = sprintf($file, $design);
						$media = $child->attributes->getNamedItem('media') ? $child->attributes->getNamedItem('media')->nodeValue : null;
						$d->addCss($file, $media);
						break;

					case 'js':
						$file = $child->attributes->getNamedItem('file')->nodeValue;
						$d->addJs($file);
						break;

					case 'i18n':
						$file = $child->attributes->getNamedItem('file')->nodeValue;
						$file = sprintf('net/keeko/cms/modules/%s/i18n/%%s/%s', $unixname, $file);
						$d->addI18n($file);
						break;
				}
			}

			$this->actions[$name] = $d;
		}

		// read config
		$this->config = new Configuration($this->entity->getId());
	}
	/**	 * Installs the module in the Keeko installation	 *	 * @return	 * @abstract	 * @access public	 */
	abstract public function install();
	/**	 * Uninstalls the module in the Keeko installation	 *	 * @return	 * @abstract	 * @access public	 */	abstract public function uninstall();	/**	 * Updates the module	 *	 * @return	 * @abstract	 * @access public	 */	abstract public function update();

	/**	 * Loads an action of this module. Processes checks wether the current user is	 * allowed to load this action.	 *	 * @param string action The actions name. The passed parameter is the name in i18n format. Thisparameter is translated into the ClassName of the desired action.	 * @return core::AbstractAction	 * @access public	 */	public function loadAction($action) {
		$unixname = $this->entity->getUnixname();
		if (!array_key_exists($action, $this->actions)) {
			throw new KeekoException(sprintf('Action (%s) not found in Module (%s)', $action, $unixname), 500);
		}

		$className = sprintf('net::keeko::cms::modules::%s::actions::%s', $this->entity->getUnixname(), $this->actions[$action]->getClassName());
		$user = KeekoRuntime::getInstance()->getUser();
		$moduleId = $this->getModuleId();



		if (!$user->hasPermission($moduleId, $action)) {
			throw new KeekoException(sprintf('Permission Denied for Action(%s) in Module (%s)', $action, $unixname), 403);
		}

		//require_once(sprintf('modules/%s/actions/%s.php', $unixname, $className));

		$obj = new $className();
		$obj->setModule($this);
		$obj->setName($action);

		$this->actions[$action]->apply();

		return $obj;	}

	public function getInstalledVersion() {
		return $this->entity->getVersion();
	}

	public function getModuleId() {
		return $this->entity->getId();
	}

	public function getVersion() {
		return $this->info['version'];
	}

	public function getAPIVersion() {
		return $this->info['api'];
	}

	public function getUnixname() {
		return $this->entity->getUnixname();
	}	public function getDefaultAction() {
		return $this->info['defaultAction'];
	}

	public function getActionNames($language) {
		$unixname = $this->entity->getUnixname();
		$fileName = sprintf('net/keeko/cms/modules/%s/i18n/%s/actions.php', $unixname, $language);

		if (file_exists($fileName)) {
			$actions = include($fileName);
		} else {
			// english by default
			$fileName = sprintf('net/keeko/cms/modules/%s/i18n/en/actions.php', $unixname);
			$actions = include($fileName);
		}

		return $actions;
	}
}?>