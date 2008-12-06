<?php
namespace net\keeko\cms\core;/************************************************************************  			core/Auth.php - Copyright thomasyou can use variables in your heading files which are replaced at generationtime. possible variables are : author, date, time, filename and filepath.just write %variable_name%This file was generated on So Feb 10 2008 at 19:38:19The original location of this file is /home/thomas/htdocs/keeko/src/core/Auth.php**************************************************************************/
use net\keeko\cms\core\entities\User;use net\keeko\cms\core\entities\peer\UserPeer;

/**
 *
 *
 * @package net.keeko.core
 */class Auth {

	private $user = null;	public function __construct() {	}
	public function getUser() {
		if (is_null($this->user)) {
			$this->recognizeUser();
		}

		return $this->user;	}

	private function recognizeUser() {
		// if user is already recognized
		if (isset($_SESSION['user'])) {
			$this->user = $_SESSION['user'];
		}

		// is a cookie with the user set?
		else if (isset($_COOKIE['user_id'])) {
			$this->user = UserPeer::retrieveByPK($_COOKIE['user_id']);

			if (isset($_COOKIE['user_password'])
					&& $_COOKIE['user_password'] == $this->user->getPasswd()) {
				$this->user->setAuthorized(true);
			}

			$_SESSION['user'] = $this->user;
		}

		// hmm, simply a guest
		else {
			$this->user = new User(true);
		}
		$this->user->updatePermissions();
	}}?>