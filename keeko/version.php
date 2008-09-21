<?php
/**
 * blabla
 * 
 * @package    net.keeko.core
 */


/**
 * Version information on Keeko
 */

/**
 * The name of the software.
 */
define('KEEKO_NAME', 'Keeko');

/**
 * The additional subname of the software.
 */
define('KEEKO_SUBNAME', 'The Content Management System');

/**
 * Interface version of Keeko. This is important for all modules. So if a module
 * does not match the API version defined here it cannot be installed.
 */
define('KEEKO_API', 1.0);

/**
 * Software release definition go along here. A release version consists of the
 * MAJOR.MINOR.MICRO string and in case of a development release or patch it
 * keeps additional information on this release.
 * 
 *		Keep an eye on these two basic rules:
 *
 * 		1) Stable releases always have KEEKO_RELEASE_NAME and KEEKO_VERSION_SUFFIX is
 * 		   empty!
 * 
 * 		2) While in development KEEKO_VERSION_SUFFIX is usually defined as '-dev'
 * 		   (or 'RC', 'alpha'/'beta' plus a number) and KEEKO_RELEASE_NAME is empty!
 */
define('KEEKO_VERSION_MAJOR', 1);
define('KEEKO_VERSION_MINOR', 0);
define('KEEKO_VERSION_MICRO', 0);
define('KEEKO_VERSION_SUFFIX', '-dev');
define('KEEKO_RELEASE_NAME', '');

/**
 * The full date of the current build. This is a human readable, full date that
 * must be changed every release.
 * 
 * Don't forget to update the ChangeLog file.
 * 
 *		* 'January 15 2006'
 */
define('KEEKO_VERSION_DATE', 'January 15 2006');

// === STOP - NO WAY! - DO NOT CHANGE FROM HERE =======================

/**
 * The KEEKO_VERSION contains the full version string. It consists of the major,
 * minor and micro version (x.x.x) plus the suffix with patch level, release
 * candidate or something else. A possible version might look like '1.2.3', 
 * '1.2.3-dev' or '1.2.3 beta2'.
 */
define('KEEKO_VERSION', KEEKO_VERSION_MAJOR . '.'
					. KEEKO_VERSION_MINOR . '.'
					. KEEKO_VERSION_MICRO
					. KEEKO_VERSION_SUFFIX);

/**
 * Complete software name string. This string contains the software name plus
 * its version. Depending if it is a stable release or an interim development
 * version, defined in the KEEKO_VERSION_SUFFIX, this might look like the following:
 * 
 *		* 'Keeko 1.2.3-dev'
 *		* 'Keeko 1.0.0'
 *		* 'Keeko 1.3.7 beta2'
 *
 * The release name defined in KEEKO_RELEASE_NAME is NOT inclued here. Look at 
 * KEEKO_FULL_IDENT instead.
 */
define('KEEKO_FULL_NAME', KEEKO_NAME . ' ' . KEEKO_VERSION);

/**
 * KEEKO_RELEASE is the definition of the release name for a stable version, or 
 * date of an interim release. Depending on the state of the software, stable
 * or development, the value will look like these:
 * 
 * 		* 'January 15 2006'				(For development release)
 * 		* 'The name of the release'		(The name as defined above) 
 */
if (KEEKO_RELEASE_NAME == '') {
	define('KEEKO_RELEASE', KEEKO_VERSION_DATE);
} else {
	define('KEEKO_RELEASE', KEEKO_RELEASE_NAME);
}

/**
 * Complete ident string of the software. Contains the name, version and the
 * release name. For a stable release this might look like:
 * 
 * 		- 'Keeko 1.0.0 (Butterfly)'
 * 
 * For a development version, this one is possible:
 * 
 * 		- 'Keeko 1.2.3-dev (January 15 2006)'
 */
define('KEEKO_FULL_IDENT', KEEKO_NAME . ' ' . KEEKO_VERSION . ' (' . KEEKO_RELEASE . ')');

/**
 * The URL of the home of this software.
 */
define('KEEKO_HOME', 'http://www.keeko.net');
?>