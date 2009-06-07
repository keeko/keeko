<?php
namespace net\keeko\cms\core;
use net\keeko\cms\core\entities\Module;



	private $info = array();

	private $actions = array();

	private $i18nActions = array();

	private $manifest = null;

	private $entity = null;
		$this->entity = $entity;
		$unixname = $this->entity->getUnixname();
		$design = KeekoRuntime::getConfig()->get('design');

		// read manifest
		$this->manifest = new \DOMDocument('1.0');
		$this->manifest->load(sprintf('%s/%s/manifest.xml', KEEKO_PATH_MODULES, $unixname));

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
			$xsl = $node->attributes->getNamedItem('xsl')->nodeValue;
			$d->setClassName($className);
			$d->setXSL($xsl);

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
						$file = sprintf('%s%s/i18n/%%s/%s', KEEKO_PATH_MODULES, $unixname, $file);
						$d->addI18n($file);
						break;
				}
			}

			$this->actions[$name] = $d;
		}

		// read config
		$this->config = new Configuration($this->entity->getId());
	}

	abstract public function install();


	/**
		$unixname = $this->entity->getUnixname();
		if (!array_key_exists($action, $this->actions)) {
			throw new KeekoException(sprintf('Action (%s) not found in Module (%s)', $action, $unixname), 500);
		}

		$className = sprintf('\\net\\keeko\\cms\\modules\\%s\\actions\\%s', $this->entity->getUnixname(), $this->actions[$action]->getClassName());
		$user = KeekoRuntime::getUser();
		$moduleId = $this->getModuleId();



		if (!$user->hasPermission($moduleId, $action)) {
			throw new KeekoException(sprintf('Permission Denied for Action(%s) in Module (%s)', $action, $unixname), 403);
		}

		//require_once(sprintf('modules/%s/actions/%s.php', $unixname, $className));

		$obj = new $className();
		$obj->setModule($this);
		$obj->setName($action);
		$obj->setDescriptor($this->actions[$action]);

		$this->actions[$action]->apply();

		return $obj;

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
	}
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
