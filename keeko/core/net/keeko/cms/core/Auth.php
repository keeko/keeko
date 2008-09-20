<?php
namespace net::keeko::cms::core;
use net::keeko::cms::core::entities::User;
/**
 *
 *
 * @package net.keeko.core
 */

	private $user = null;

		if (is_null($this->user)) {
			$this->recognizeUser();
		}

		return $this->user;

	private function recognizeUser() {
		// if user is already recognized
		if (isset($_SESSION['user'])) {
			$this->user = $_SESSION['user'];
			$this->user->updatePermissions();
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
			$this->user->updatePermissions();
		}

	}