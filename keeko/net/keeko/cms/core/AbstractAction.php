<?php
namespace net::keeko::cms::core;/************************************************************************  			core/AbstractAction.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/AbstractAction.php**************************************************************************/use net::keeko::cms::core::page::IContentElement;/** * class AbstractAction * Abstract handler for module actions. Defines an interface for subclassing * actions and handles as collector for passed parameters.
 *
 * @package net.keeko.core */abstract class AbstractAction implements IContentElement {	/**	 * Contains parameter information	 * @access protected	 */	protected $params;

	protected $module;

	protected $page;

	protected $xml;

	protected $name;	public function __construct() {
		$this->page = KeekoRuntime::getInstance()->getPage();

		$this->xml = new DOMDocument('1.0', 'utf-8');
		$action = $this->xml->createElement('action');
		$this->xml->appendChild($action);
	}
	/**	 * set a parameter that is passed from the url or by configuration	 *	 * @param string key The parameter's key	 * @param string value The parameter's value	 * @return	 * @access public	 */	public function setParam($key, $value) {		$this->params[$key] = $value;	}	/**	 * general run method the constructs the xml, regarding the passed parameters	 *	 * @return	 * @abstract	 * @access public	 */	abstract public function run();	/**	 * returns the path for the stylesheet associated with this action and	 * output-method	 *	 * @return string	 * @abstract	 * @access public	 */	abstract public function getXSL();

	public function setName($name) {
		$this->name = $name;
		$this->xml->documentElement->setAttribute('name', $name);
	}
	public function setModule($module) {
		$this->module = $module;
		$this->xml->documentElement->setAttribute('module', $this->module->getUnixname());
	}
}?>