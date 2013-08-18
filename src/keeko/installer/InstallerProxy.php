<?php
namespace keeko\installer;

use Composer\Script\CommandEvent;
use Composer\Script\PackageEvent;

class InstallerProxy {

	public static function preInstall(CommandEvent $event) {
		if (self::hasInstaller()) {
			\keeko\core\installer\ComposerInstaller::preInstall($event);
		}
	}

	public static function installPackage(PackageEvent $event) {
		if (self::hasInstaller()) {
			\keeko\core\installer\ComposerInstaller::installPackage($event);
		}
	}

	public static function updatePackage(PackageEvent $event) {
		if (self::hasInstaller()) {
			\keeko\core\installer\ComposerInstaller::updatePackage($event);
		}
	}

	public static function uninstallPackage(PackageEvent $event) {
		if (self::hasInstaller()) {
			\keeko\core\installer\ComposerInstaller::uninstallPackage($event);
		}
	}

	public static function postInstall(CommandEvent $event) {
		if (self::hasInstaller() && $event->getComposer()->getPackage()->getName() == 'keeko/keeko') {
			$installer = new \keeko\core\installer\KeekoInstaller();
			$installer->installKeeko();
		}
	}

	private static function hasInstaller() {
		return class_exists('\\keeko\\core\\installer\\ComposerInstaller');
	}
}