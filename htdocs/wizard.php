<?php
define('KEEKO_PATH', '../keeko/');

require KEEKO_PATH . 'bootstrap.php';

use net\keeko\utils\wizard\Wizard;
use net\keeko\utils\wizard\Step;
use net\keeko\cms\core\output\Renderer;


$wiz = new Wizard();

$step1 = new Step($wiz, 'step1');
$step2 = new Step($wiz, 'step2');

$wiz->addStep($step1);
$wiz->addStep($step2);


$renderer = new Renderer();
$renderer->addStyleSheet($wiz->getTemplate());
$renderer->setSource($wiz->toXml());
echo $renderer->render();
?>