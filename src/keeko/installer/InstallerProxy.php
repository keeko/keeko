<?php
namespace keeko\installer;

use Composer\Script\CommandEvent;
use Composer\Script\PackageEvent;

class InstallerProxy {

	public static function preInstall(CommandEvent $event) {
		if (self::hasInstaller()) {
			\keeko\core\installer\DelegateInstaller::preInstall($event);
		}
	}

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

	public static function postInstall(CommandEvent $event) {
		if (self::hasInstaller() && $event->getComposer()->getPackage()->getName() == 'keeko/keeko') {
			$event->getIO()->write('Install Keeko', true);
			$installer = new \keeko\core\installer\KeekoInstaller();
			$installer->installKeeko($event->getIO(), $event->getComposer());
		}
	}

	private static function hasInstaller() {
		return class_exists('\\keeko\\core\\installer\\KeekoInstaller');
	}
}