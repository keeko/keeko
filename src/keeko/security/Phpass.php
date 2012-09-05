<?php
namespace keeko\security;

use Symfony\Component\Config\FileLocator;

use Hautelook\Phpass\PasswordHash;

use Symfony\Component\Yaml\Yaml;

class Phpass implements PasswordHasherInterface
{
	/**
	 * The adapter for hashing passwords
	 * @var \Hautelook\Phpass\PasswordHash
	 */
	private $adapter;

	/**
	 * Constructor
	 */
	public function __construct() {
		$strength = 8;
		$portable = false;

		try {
			$locator = new FileLocator(KEEKO_PATH_CONFIG);
			$configFile = $locator->locate('security.yml', null, true);

			$config = Yaml::parse($configFile);
			if (array_key_exists('phpass', $config)) {
				if (array_key_exists('strength', $config['phpass'])) {
					$strength = $config['phpass']['strength'];
				}
				if (array_key_exists('portable', $config['phpass'])) {
					$portable = $config['phpass']['portable'];
				}
			}
		} catch(\InvalidArgumentException $e) {}

		$this->adapter = new PasswordHash($strength, $portable);
	}

	/**
	 * Hashes the provided plaintext password and returns the hashed one
	 *
	 * @param string $password
	 * @return string
	 */
	public function hash($password) {
		return $this->adapter->HashPassword($password);
	}

	/**
	 * Validates a given plaintext password against the given hashed password
	 *
	 * @param string $password
	 * @param string $hash
	 * @return bool
	 */
	public function validate($password, $hash) {
		return $this->adapter->CheckPassword($password, $hash);
	}
}
