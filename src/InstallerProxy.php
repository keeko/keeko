<?php
namespace keeko\keeko;

use Composer\Script\PackageEvent;

class InstallerProxy {

	private static $install = [];
	private static $update = [];
	private static $uninstall = [];

	public static function installPackage(PackageEvent $event) {
		static::$install[] = $event;
	}

	public static function updatePackage(PackageEvent $event) {
		static::$update[] = $event;
	}

	public static function uninstallPackage(PackageEvent $event) {
		static::$uninstall[] = $event;
	}

	public static function process() {
// 		require_once(__DIR__ . '/bootstrap.php');
// 		$class = '\\keeko\\framework\\installer\\DelegateInstaller';
// 		if (class_exists($class)) {
// 			$installer = new $class();
// 			$installer->process(static::$install, static::$update, static::$uninstall);
// 		}
	}
}