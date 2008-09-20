<?php
namespace net::keeko::cms::core;
use net::keeko::cms::core::entities::Page;
use net::keeko::cms::core::output::Renderer;
 * 
 * @package net.keeko.core


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
	}