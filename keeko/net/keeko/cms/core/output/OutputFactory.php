<?php/************************************************************************  			core/output/OutputFactory.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/output/OutputFactory.php**************************************************************************/namespace net::keeko::cms::core::output;/** * class OutputFactory * The OutputProcessorFactory generates the desired OutputProcessor.
 * 
 * @package net.keeko.cms.core.output */class OutputFactory {	const AJAT = 'ajat';
	const AJAX = 'ajax';
	const JSON = 'json';
	const RAW = 'raw';	const XSL = 'xsl';
	const XHTML1 = 'xhtml1';
	
	private $suffixMap = array(
		OutputFactory::AJAT => 'AJAT',
		OutputFactory::AJAX => 'AJAX',
		OutputFactory::JSON => 'JSON',
		OutputFactory::RAW => 'RAW',		OutputFactory::XSL => 'XSL',
		OutputFactory::XHTML1 => 'XHTML1', 
	);	private static $instance = null;
	private function __construct() {}	public static function getInstance() {		if (is_null(self::$instance)) {
			self::$instance = new OutputFactory();
		}
		
		return self::$instance;	}	/**	 *	 * @param string output output constant	 * @return OutputProcessor	 * @access public	 */	public function newOutputProcessor($output = 'xhtml1') {
		$className = sprintf('net::keeko::cms::core::output::%sOutputProcessor', $this->suffixMap[$output]);
		return new $className();	}}?>