<?php
namespace net\keeko\cms\core;
 *
 * @package		net.keeko.core
 */

	const INT = 1;
	const BOOL = 2;
	const FLOAT = 3;
	const MULTIPLE = 4;
	const STRING = 5;
	public function __construct($moduleId = null) {
		$this->load($moduleId);
	}
		if (!is_null($moduleId)) {
			$c->add(SettingPeer::MODULE_ID, $moduleId);
		}

		$settings = SettingPeer::doSelect($c);

		foreach ($settings as $setting) {
			$value;
			switch ($setting->getFormat()) {
				case self::INT:
				case self::BOOL:
				case self::MULTIPLE:
					$value = (int)$setting->getValue();
					break;

				case self::STRING:
				default:
					$value = $setting->getValue();
					break;
			}

			$this->configMap[$setting->getKeyname()] = $value;
		}
			return $this->configMap[$key];
		}

	public function set($key, $value) {
		$this->configMap[$key] = $value;
	}

	public function save($key, $value) {
		if (array_key_exists($key, $value)) {
			$setting = SettingPeer::retrieveByPK($key);
			$setting->setValue($value);
			$setting->save();
			$this->configMap[$key] = $value;
		}
	}