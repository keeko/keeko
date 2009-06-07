<?php
namespace net\keeko\cms\core;
use net\keeko\cms\core\entities\Page;
use net\keeko\cms\core\output\Renderer;
use net\keeko\cms\core\entities\Language;
use net\keeko\cms\core\entities\peer\LanguagePeer;
 *
 * @package net.keeko.core

	/**

	/**
	 *
	 * @access private
	 * @var Classpath
	 */
	private $classpath;


	/**
	 * The current User
	 * @access private
	 */
	private $user;

	/**
	 * Renderer for everybody
	 * @access private
	 */
	private $renderer;

	/**
	 * Array with i18n files
	 * @access private
	 */
	private $i18n = array();
	private function __construct() {
		$this->config = new Configuration();
		$auth = new Auth();
		$this->user = $auth->getUser();
		$this->moduleManager = new ModuleManager();
		$this->renderer = new Renderer();
		$this->languages = LanguagePeer::doSelect(new \Criteria());
		foreach ($this->languages as $language) {
			if ($language->getIsDefault()) {
				$this->contentLanguage = $language;
				break;
			}
		}
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

		$runtime = self::getInstance();
		$runtime = self::getInstance();

	public static function getLanguages() {
		$runtime = self::getInstance();
		return $runtime->languages;
	}
		$runtime = self::getInstance();
		$runtime = self::getInstance();

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
	public static function getModuleManager() {
		$runtime = self::getInstance();
		return $runtime->moduleManager;
	}

	public static function setPage(Page $page) {
		$runtime = self::getInstance();
		$runtime->page = $page;
	}

	public static function getPage() {
		$runtime = self::getInstance();
		return $runtime->page;
	}

	public static function removeI18n($file) {
		$runtime = self::getInstance();
		$offset = array_search($file, $runtime->i18n);
		if ($offset) {
			unset($runtime->i18n[$offset]);
		}
	}

	public static function setCookie($key, $value) {
		// TODO: set cookie domain AND path
		setcookie($key, $value, time() + 365 * 24 * 3600, '/keeko');
	}