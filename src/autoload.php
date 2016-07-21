<?php
require_once __DIR__ . '/../vendor/autoload.php';

// workaround for https://github.com/composer/composer/issues/5533
$filename = __DIR__ . '/../.puli/GeneratedPuliFactory.php';
if (!class_exists(PULI_FACTORY_CLASS) && file_exists($filename)) {
	require_once $filename;
}
