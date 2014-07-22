<?php
namespace keeko\installer;

use Composer\Script\CommandEvent;
use Composer\Script\PackageEvent;

class InstallerProxy {

	public static function installPackage(PackageEvent $event) {
		if (self::hasInstaller()) {
			\keeko\core\installer\DelegateInstaller::installPackage($event);
		}
	}

	public static function updatePackage(PackageEvent $event) {
		if (self::hasInstaller()) {
			\keeko\core\installer\DelegateInstaller::updatePackage($event);
		}
	}

	public static function uninstallPackage(PackageEvent $event) {
		if (self::hasInstaller()) {
			\keeko\core\installer\DelegateInstaller::uninstallPackage($event);
		}
	}

	private static function hasInstaller() {
		return class_exists('\\keeko\\core\\installer\\DelegateInstaller');
	}
}