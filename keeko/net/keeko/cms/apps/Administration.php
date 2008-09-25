<?php
namespace net::keeko::cms::apps;/************************************************************************  			apps/Administration.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/apps/Administration.php**************************************************************************/
use net::keeko::cms::core::AbstractApplication;
use net::keeko::cms::core::KeekoRuntime;
use net::keeko::cms::core::KeekoException;
use net::keeko::cms::core::entities::Page;
use net::keeko::cms::core::entities::Block;
use net::keeko::cms::core::entities::MenuPeer;
use net::keeko::cms::core::output::OutputFactory;/** * class Administration * The Administration handles the administration area
 *
 * @package net.keeko.core
 * @subpackage apps */class Administration extends AbstractApplication{	public function __construct() {
		parent::__construct();
	}
	public function run() {
		try {
			$page = new Page();
			$runtime = KeekoRuntime::getInstance();
			$runtime->setPage($page);
			$moduleManager = $runtime->getModuleManager();
			$renderer = $runtime->getRenderer();

			// design, set this to global 'design' for common usage. It's only for this request
			$design = $runtime->getConfig()->get('admin_design');
			$runtime->getConfig()->set('design', $design);

			// referer check against session riding
			if (isset($_SERVER['HTTP_REFERER']) &&
				($_SERVER['HTTP_REFERER'] == ''
					|| !strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']))) {
				unset($_COOKIE['keeko_admin']);
			}

			$format = isset($_GET['format']) ? $_GET['format'] : 'xhtml1';
			$outputFactory = OutputFactory::getInstance();
			$outputProcessor = $outputFactory->newOutputProcessor($format);

			$moduleName = isset($_GET['module']) ? $_GET['module'] : 'Admin';


			// check wether session is active
			if (isset($_COOKIE['keeko_admin']) && $_COOKIE['keeko_admin']) {
				$module = $moduleManager->getModule($moduleName);
				$actionName = isset($_GET['action']) ? $_GET['action'] : $module->getDefaultAction();
				$renderer->addStyleSheet(sprintf('admin/designs/%s/%s/main.xsl', $design, $format));

				// extend admin session period
				setcookie('keeko_admin', true, time() + 1800);
			} else {
				$moduleName = 'Admin';
				$actionName = 'login';
				$module = $moduleManager->getModule($moduleName);
				$renderer->addStyleSheet(sprintf('admin/designs/%s/%s/logged_out.xsl', $design, $format));
			}

			$action = $module->loadAction($actionName);
			$action->run();

			$xsl = $action->getXSL();
			$xslPath = sprintf('%s/modules/%s/templates/%s/%s', KEEKO_PATH, $moduleName, $format, $xsl);
			if ($xsl && file_exists($xslPath)) {
				$renderer->addStyleSheet($xslPath);
			}

			$c = new ::Criteria();
			$c->add(MenuPeer::IS_ADMIN, 1);
			$adminMenu = MenuPeer::doSelectOne($c);

			$menu = new Block();
			$menu->setName('menu');
			$menu->addContentElement($adminMenu);

			$content = new Block();
			$content->setName('content');
			$content->addContentElement($action);

			$page->addBlock($content);
			$page->addBlock($menu);

			$source = new DOMDocument('1.0', 'utf-8');
			$keeko = $source->createElement('keeko');

			$pageNode = $source->importNode($page->toXML()->documentElement, true);
			$userNode = $source->importNode($runtime->getUser()->toXML()->documentElement, true);

			// i18n
			$i18n = $source->createElement('i18n');
			$runtime->addI18n('admin/i18n/%s/menu.xml');
			$this->addMenuI18n($adminMenu);

			$doc = new DOMDocument();
			foreach ($runtime->getI18n() as $file) {
				$doc->load(sprintf($file, $runtime->getInterfaceLanguage()));
				$node = $source->importNode($doc->documentElement, true);
				$i18n->appendChild($node);
			}

			// some settings
			$settings = $source->createElement('settings');
			$contentLanguage = $source->createElement('contentLanguage', $runtime->getContentLanguage());
			$ifaceLanguage = $source->createElement('interfaceLanguage', $runtime->getInterfaceLanguage());
			$url = $source->createElement('url', $_SERVER['PHP_SELF'] . '?' . ::xmlentities($_SERVER['QUERY_STRING']));
			$mode = $source->createElement('mode', isset($_GET['mode']) && $_GET['mode'] == 'window' ? 'window' : 'normal');

			$settings->appendChild($contentLanguage);
			$settings->appendChild($ifaceLanguage);
			$settings->appendChild($url);
			$settings->appendChild($mode);

			$keeko->appendChild($userNode);
			$keeko->appendChild($settings);
			$keeko->appendChild($pageNode);
			$keeko->appendChild($i18n);

			$source->appendChild($keeko);
			$renderer->setSource($source);

//			header('Content-Type: application/xhtml+xml; charset=utf-8');
//			$sheet = $renderer->getStyleSheet();
//			$sheet->formatOutput = true;
//			echo $sheet->saveXML();
//			exit;
			$outputProcessor->setRenderer($renderer);
			$outputProcessor->display();

		} catch(KeekoException $e) {
			echo $e->getMessage() . '<br/><pre>' .$e->getTraceAsString();
		}	}

	private function addMenuI18n($parent, $parentNode = null) {
		if (count($parent->getItems())) {
			foreach ($parent->getItems() as $item) {
				if ($item->getAction() && $module = $item->getModule()) {
					KeekoRuntime::getInstance()->addI18n(KEEKO_PATH.'/modules/' . $module->getUnixname() . '/i18n/%s/menu.xml');
				}
				$this->addMenuI18n($item);
			}
		}
	}}?>