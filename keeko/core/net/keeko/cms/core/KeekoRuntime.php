<?php
namespace net::keeko::cms::core;/************************************************************************  			core/KeekoRuntime.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/KeekoRuntime.php**************************************************************************/
use net::keeko::cms::core::entities::Page;
use net::keeko::cms::core::output::Renderer;/** * class KeekoRuntime * The KeekoRuntime class is the main organizer and handles connections to all the * important objects. (blabla)
 * 
 * @package net.keeko.core */class KeekoRuntime {	/**	 * Handles the only instance of the module manager	 * @access public	 */	public $moduleManager;	/**	 * Holds the Keeko configuration	 * @access public	 */	public $config;
	/**	 * Instance of the current page	 * @access private	 */	private $page;

	/**
	 * The current User
	 * @access private
	 */
	private $user;

	/**
	 * Renderer for everybody
	 * @access private
	 */
	private $renderer;	/**	 * Keeps a list of all available languages	 * @access private	 */	private $languages;	/**	 * Current interface language	 * @access private	 */	private $interfaceLanguage = 'en';	/**	 * Current content language	 * @access private	 */	private $contentLanguage = 'en';
	
	/**
	 * Array with i18n files
	 * @access private
	 */
	private $i18n = array();	private static $instance = null;
	private function __construct() {
		$this->config = new Configuration();
		$auth = new Auth();
		$this->user = $auth->getUser();
		$this->moduleManager = new ModuleManager();
		$this->renderer = new Renderer();
	}

	/**
	 * Returns instance of KeekoRuntime.
	 * 
	 * @return KeekoRuntime
	 */
	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new KeekoRuntime();
		}

		return self::$instance;
	}
	public function addI18n($file) {
		if (!in_array($file, $this->i18n)) {
			$this->i18n[] = $file;
		}
	}
	
	public function getRenderer() {
		return $this->renderer;
	}

	
	public function getUser() {
		return $this->user;
	}

	
	public function getConfig() {
		return $this->config;
	}

	
	public function getI18n() {
		return $this->i18n;
	}
	/**	 * Returns the current content language	 *	 * @return int	 * @access public	 */	public function getContentLanguage() {		return $this->contentLanguage;	}	/**	 * Sets new content language	 *	 * @param int lang The id for the new content language	 * @return int	 * @access public	 */	public function setContentLanguage($lang) {		$this->contentLanguage = $lang;	}	/**	 * Returns the interface language	 *	 * @return int	 * @access public	 */	public function getInterfaceLanguage() {		return $this->interfaceLanguage;	}	/**	 *	 * @param int lang The id for the new interface language	 * @return int	 * @access public	 */	public function setInterfaceLanguage($lang) {		$this->interfaceLanguage = $lang;	}
	public function getModuleManager() {
		return $this->moduleManager;
	}

	public function setPage(Page $page) {
		$this->page = $page;
	}
	
	public function getPage() {
		return $this->page;
	}
	
	public function removeI18n($file) {
		$offset = array_search($file, $this->i18n);
		if ($offset) {
			unset($this->i18n[$offset]);
		}
	}
	
	public function setCookie($key, $value) {
		// TODO: set cookie domain AND path
		setcookie($key, $value, time() + 365 * 24 * 3600, '/keeko');
	}}?>