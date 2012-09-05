<?php
namespace keeko;
use keeko\entities\Module;

class ModuleDescriptor {

	private $module;
	private $unixname;
	private $directory;
	private $manifest;
	private $version;
	private $apiVersion;
	private $defaultAction;
	private $authors;
	private $actions;

	public function __construct($unixname) {
		$this->unixname = $unixname;
		$this->directory = KEEKO_PATH_MODULES . DIRECTORY_SEPARATOR . $unixname
			. DIRECTORY_SEPARATOR;

		// read manifest
		$this->manifest = new \DOMDocument('1.0');
		$this->manifest->load($this->directory . 'manifest.xml');

		// general info part
		$this->apiVersion = $this->getValue($this->manifest, '//api');
		$this->version = $this->getValue($this->manifest, '//version');
		$this->defaultAction = $this->getValue($this->manifest, '//defaultAction');

		// authors
		$authors = $this->manifest->getElementsByTagName('author');

		for ($i = 0; $i < $authors->length; $i++) {
			/* @var $node \DOMElement */
			$node = $authors->item($i);
			$this->authors[] = array(
				'name' => $node->getAttribute('name'),
				'email' => $node->getAttribute('email'),
				'homepage' => $node->getAttribute('homepage')
			);
		}

		// actions
		$actionList = $this->manifest->getElementsByTagName('action');

		// 		for ($i = 0; $i < $actionList->length; $i++) {
		// 			$d = new ActionDescriptor();
		// 			$node = $actionList->item($i);
		// 			$name = $node->attributes->getNamedItem('name')->nodeValue;
		// 			$className = $node->attributes->getNamedItem('className')->nodeValue;
		// 			$xsl = $node->attributes->getNamedItem('xsl')->nodeValue;
		// 			$d->setClassName($className);
		// 			$d->setXSL($xsl);

		// 			$childs = $node->childNodes;
		// 			for ($j = 0; $j < $childs->length; $j++) {
		// 				$child = $childs->item($j);
		// 				switch ($child->nodeName) {
		// 					case 'css':
		// 						$file = $child->attributes->getNamedItem('file')->nodeValue;
		// 						$file = sprintf($file, $design);
		// 						$media = $child->attributes->getNamedItem('media') ? $child->attributes->getNamedItem('media')->nodeValue : null;
		// 						$d->addCss($file, $media);
		// 						break;

		// 					case 'js':
		// 						$file = $child->attributes->getNamedItem('file')->nodeValue;
		// 						$d->addJs($file);
		// 						break;

		// 					case 'i18n':
		// 						$file = $child->attributes->getNamedItem('file')->nodeValue;
		// 						$file = sprintf('%s%s/i18n/%%s/%s', KEEKO_PATH_MODULES, $unixname, $file);
		// 						$d->addI18n($file);
		// 						break;
		// 				}
		// 			}

		// 			$this->actions[$name] = $d;
		// 		}
	}

	private function getValue(\DOMDocument $doc, $xpath) {
		$query = new \DOMXPath($doc);
		return $query->query($xpath)->item(0)->nodeValue;
	}

	/**
	 *
	 * @return Module
	 */
	public function getModule() {
		return $this->module;
	}

	/**
	 * @return string
	 */
	public function getUnixname() {
		return $this->unixname;
	}

	/**
	 * @return string
	 */
	public function getDirectory() {
		return $this->directory;
	}

	/**
	 * @return \DOMDocument
	 */

	public function getManifest() {
		return $this->manifest;
	}

	/**
	 * @return string
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * @return string
	 */
	public function getApiVersion() {
		return $this->apiVersion;
	}

	/**
	 * @return string
	 */
	public function getDefaultAction() {
		return $this->defaultAction;
	}

	/**
	 * Returns the authors for this module in an associative array.
	 * Keys are: name, email (optional), homepage (optional)
	 *
	 * @return array
	 */
	public function getAuthors() {
		return $this->authors;
	}

	/**
	 * @return array
	 */
	public function getActions() {
		return $this->actions;
	}

	/**
	 * Sets the Module model
	 *
	 * @param Module $module
	 * @return ModuleDescriptor this
	 */
	public function setModule($module) {
		$this->module = $module;
		return $this;
	}

}
