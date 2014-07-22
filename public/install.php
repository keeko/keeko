<?php
use keeko\core\installer\KeekoInstaller;

require_once '../src/bootstrap.php';

$installer = new KeekoInstaller();
$installer->install();

echo 'done';