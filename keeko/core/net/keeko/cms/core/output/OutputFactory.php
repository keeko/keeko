<?php
 *
 * @package net.keeko.cms.core.output
	const AJAX = 'ajax';
	const JSON = 'json';
	const RAW = 'raw';
	const XHTML1 = 'xhtml1';

	private $suffixMap = array(
		OutputFactory::AJAT => 'AJAT',
		OutputFactory::AJAX => 'AJAX',
		OutputFactory::JSON => 'JSON',
		OutputFactory::RAW => 'RAW',
		OutputFactory::XHTML1 => 'XHTML1',
	);
	private function __construct() {}
			self::$instance = new OutputFactory();
		}

		return self::$instance;
		$className = sprintf('\\net\\keeko\\cms\\core\\output\\%sOutputProcessor', $this->suffixMap[$output]);
		return new $className();