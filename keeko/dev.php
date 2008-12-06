<?php
// Here you have the opportunity to define your development environment.
// Rename this file to dev.php and it will be included in your keeko installation.
//
// Possible actions:
// - Define Keeko Constants
// - Set Firephp as debugger with AJAX Requests


defined('KEEKO_PATH') or define('KEEKO_PATH', dirname(__FILE__) . '/');
defined('KEEKO_PATH_LIBS') or define('KEEKO_PATH_LIBS', KEEKO_PATH . '../libs/');
defined('KEEKO_PATH_MODULES') or define('KEEKO_PATH_MODULES', KEEKO_PATH . '../../Keeko-Modules/');
defined('KEEKO_PATH_APPS') or define('KEEKO_PATH_APPS', KEEKO_PATH . '../../Keeko-Apps/');
//defined('KEEKO_PATH_CORE') or define('KEEKO_PATH_CORE', '');


?>