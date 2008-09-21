<?php
define('KEEKO_PATH', '../keeko');
try {
	require '../keeko/admin.php'; 
} catch (Exception $exception) { 
	echo '<html><body><center>'  
		. 'An exception occured while bootstrapping the application.';
	if (defined('KEEKO_ENVIRONMENT') 
			&& KEEKO_ENVIRONMENT != 'production'  ) {
		echo '<br /><br />' . $exception->getMessage() . '<br />'  
		. '<div align="left">Stack Trace:' . '<pre>' 
		. $exception->getTraceAsString() . '</pre></div>'; 
	} 
	echo '</center></body></html>'; 
	exit(1); 
} 
?> 