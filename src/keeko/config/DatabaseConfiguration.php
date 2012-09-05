<?php
namespace keeko\config;

use Symfony\Component\Yaml\Yaml;

use Symfony\Component\Config\Loader\FileLoader;


class DatabaseConfiguration extends FileLoader {

	private $host;
	private $database;
	private $user;
	private $password;

	public function load($resource, $type = null) {
		$config = Yaml::parse($resource);

		foreach ($config as $k => $v) {
			$this->$k = $v;
		}
	}

	public function supports($resource, $type = null) {
		return is_string($resource) && 'yml' === pathinfo($resource, PATHINFO_EXTENSION);
	}

	public function getHost() {
		return $this->host;
	}

	public function getDatabase() {
		return $this->database;
	}

	public function getUser() {
		return $this->user;
	}

	public function getPassword() {
		return $this->password;
	}
}
