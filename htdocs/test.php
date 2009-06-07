<?php
function load($class) {
	echo $class .'<br>';
}
spl_autoload_register('load');

use my\whatever\namespc;

$foo = new Foo();
?>