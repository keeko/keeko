<?php
namespace net\keeko\cms\core;/************************************************************************  			core/KeekoRuntime.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/KeekoRuntime.php**************************************************************************/
use net\keeko\cms\core\entities\Page;
use net\keeko\cms\core\output\Renderer;/** * class KeekoRuntime * The KeekoRuntime class is the main organizer and handles connections to all the * important objects. (blabla)
 *
 * @package net.keeko.core */class KeekoRuntime {	/**	 * Handles the only instance of the module manager	 * @access public	 */	private $moduleManager;

	/**	 * Holds the Keeko configuration	 * @access public	 */	private $config;

	/**
	 *
	 * @access private
	 * @var Classpath
	 */
	private $classpath;
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
	private static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new KeekoRuntime();
		}

		return self::$instance;
	}

	public static function addI18n($file) {
		$runtime = self::getInstance();
		if (!in_array($file, $runtime->i18n)) {
			$runtime->i18n[] = $file;
		}
	}

	public static function getRenderer() {
		$runtime = self::getInstance();
		return $runtime->renderer;
	}


	public static function getUser() {
		$runtime = self::getInstance();
		return $runtime->user;
	}

	public static function getConfig() {
		$runtime = self::getInstance();
		return $runtime->config;
	}


	public static function getI18n() {
		$runtime = self::getInstance();
		return $runtime->i18n;
	}
	/**	 * Returns the current content language	 *	 * @return int	 * @access public	 */	public static function getContentLanguage() {
		$runtime = self::getInstance();		return $runtime->contentLanguage;	}	/**	 * Sets new content language	 *	 * @param int lang The id for the new content language	 * @return int	 * @access public	 */	public function setContentLanguage($lang) {
		$runtime = self::getInstance();		$runtime->contentLanguage = $lang;	}	/**	 * Returns the interface language	 *	 * @return int	 * @access public	 */	public function getInterfaceLanguage() {
		$runtime = self::getInstance();		return $runtime->interfaceLanguage;	}	/**	 *	 * @param int lang The id for the new interface language	 * @return int	 * @access public	 */	public static function setInterfaceLanguage($lang) {
		$runtime = self::getInstance();		$runtime->interfaceLanguage = $lang;	}

	/**
	 *
	 * @return \Classpath
	 */
	public static function getClasspath() {
		$runtime = self::getInstance();
		return $runtime->classpath;
	}

	public static function setClasspath(\Classpath $cp) {
		$runtime = self::getInstance();
		$runtime->classpath = $cp;
	}
	public function getModuleManager() {
		$runtime = self::getInstance();
		return $runtime->moduleManager;
	}

	public function setPage(Page $page) {
		$runtime = self::getInstance();
		$runtime->page = $page;
	}

	public function getPage() {
		$runtime = self::getInstance();
		return $runtime->page;
	}

	public function removeI18n($file) {
		$runtime = self::getInstance();
		$offset = array_search($file, $runtime->i18n);
		if ($offset) {
			unset($runtime->i18n[$offset]);
		}
	}

	public function setCookie($key, $value) {
		// TODO: set cookie domain AND path
		setcookie($key, $value, time() + 365 * 24 * 3600, '/keeko');
	}}?>