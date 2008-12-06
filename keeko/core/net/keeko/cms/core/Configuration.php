<?php
namespace net\keeko\cms\core;/************************************************************************  			core/Configuration.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/Configuration.php**************************************************************************/use net\keeko\cms\core\entities\peer\SettingPeer;/** * class Configuration * Encapsulates the configuration for either the keeko core system, the user or a * module
 *
 * @package		net.keeko.core
 */class Configuration {

	const INT = 1;
	const BOOL = 2;
	const FLOAT = 3;
	const MULTIPLE = 4;
	const STRING = 5;	/**	 * Contains the key-based parsed configuration	 * @access private	 */	private $configMap = array();
	public function __construct($moduleId = null) {
		$this->load($moduleId);
	}	public function load($moduleId = null) {		$c = new \Criteria();
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
		}	}	/**	 *	 * @param string key The key of the retrieved configuration value	 * @return mixed	 * @access public	 */	public function get($key) {		if (array_key_exists($key, $this->configMap)) {
			return $this->configMap[$key];
		}	}

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
	}}?>