<?php
require_once 'bootstrap.php';

use net\keeko\cms\core\KeekoRuntime;
use net\keeko\cms\core\KeekoException;
use net\keeko\cms\core\entities\App;
use net\keeko\cms\core\entities\peer\AppPeer;
use net\keeko\cms\core\entities\peer\AppUriPeer;


// figure out, which application to start
$fullRequest = str_replace('//', '/', $_SERVER['HTTP_HOST'] . '/' . $_SERVER['REQUEST_URI']);
$appUri = dirname($fullRequest);

// admin
if (basename($_SERVER['PHP_SELF']) == 'keeko.php') {
	$app = AppPeer::retrieveByPK(1);
}

// detect in database
else {
	$con = \Propel::getConnection();
	$sql = 'SELECT uri, app_id, CHAR_LENGTH(uri) as len FROM ' . AppUriPeer::TABLE_NAME . ' WHERE :p LIKE uri ORDER BY len DESC LIMIT 1';
	$stmt = $con->prepare($sql);
	$stmt->bindParam(':p', $appUri);
	$stmt->execute();

	$result = $stmt->fetch();

	if ($result) {
		$app = AppPeer::retrieveByPK($result['app_id']);
		$app->setCurrentUri(str_replace('%', '', $result['uri']));
	}
}

// forward file if exists
if ($app) {
	if ($app->getCurrentUri()) {
		$requestFileName = str_replace($app->getCurrentUri(), '', $fullRequest);
		if (stristr($requestFileName, 'modules')) {
			$fileName = str_replace('//', '/', sprintf('%s/%s', KEEKO_PATH_MODULES, str_replace('modules', '', $requestFileName)));
		} else {
			$fileName = str_replace('//', '/', sprintf('%s/%s/%s', KEEKO_PATH_APPS, $app->getUnixname(), $requestFileName));
		}

		if (file_exists($fileName)) {
			sendFile($fileName);
		}
	}
} else {
	throw new KeekoException('App not found');
}

// load and run app
try {
	$path = KEEKO_PATH_APPS . $app->getUnixname() . '/src';
	KeekoRuntime::getClasspath()->addPath($path);

	$className = sprintf('\\net\\keeko\\cms\\apps\\%s', $app->getClassname());
	$admin = new $className();
	$admin->run();
} catch(PropelException $e) {
	echo $e->getCause();
}


?>