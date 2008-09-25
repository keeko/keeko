<?php
header('Content-Type: text/javascript, charset: utf-8');

echo '(function() { $package("keeko");'."\n";
$di = new DirectoryIterator('./src');
foreach ($di as $file) {
	if ($file->isFile()) {
		echo file_get_contents($file->getPath() . '/'. $file->getFilename())."\n";
	}
}

$l = !empty($_GET['l']) ? $_GET['l'] : 'en';

$fileName = sprintf('../i18n/%s/js.xml', $l);
if (!file_exists($fileName)) {
	$fileName = '../i18n/en/js.xml';
}

$i18n = new DOMDocument('1.0');
$i18n->load($fileName);

printI18n($i18n->documentElement, 'global');

echo "\n".'
if (gara && gara.i18n) {
	gara.i18n.set("yes", keeko.i18n.get("global.yes"));
	gara.i18n.set("no", keeko.i18n.get("global.no"));
	gara.i18n.set("ok", keeko.i18n.get("global.ok"));
	gara.i18n.set("cancel", keeko.i18n.get("global.cancel"));
	gara.i18n.set("abort", keeko.i18n.get("global.abort"));
	gara.i18n.set("retry", keeko.i18n.get("global.retry"));
	gara.i18n.set("ignore", keeko.i18n.get("global.ignore"));
}

$package("");})();

function XHR() {
	var xmlhttp;
	(function() {
		if (typeof XMLHttpRequest != "undefined") {

			xmlhttp = XMLHttpRequest();
		} else {
			try {
				xmlhttp = ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp = false;
				}
			}
		}
	})();
	return xmlhttp;
}';

function printI18n(DOMNode $parent, $canonical) {
	for ($i = 0, $len = $parent->childNodes->length; $i < $len; $i++) {
		$node = $parent->childNodes->item($i);

		if ($node->nodeType == XML_ELEMENT_NODE) {
			if (!hasElementNodes($node)) {
				printf('keeko.i18n.set("%s.%s", "%s");'."\n", $canonical, $node->nodeName, trim($node->nodeValue));
			}
			printI18n($node, $canonical . '.' . $node->nodeName);
		}
	}
}

function hasElementNodes(DOMNode $node) {
	$counter = 0;
	for ($i = 0, $len = $node->childNodes->length; $i < $len; $i++) {
		$child = $node->childNodes->item($i);

		if ($child->nodeType == XML_ELEMENT_NODE) {
			$counter++;
		}
	}

	return $counter > 0;
}
?>