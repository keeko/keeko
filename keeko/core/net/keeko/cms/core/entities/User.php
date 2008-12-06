<?php

namespace net\keeko\cms\core\entities;

use net\keeko\cms\core\entities\peer\ActionPeer;
use net\keeko\cms\core\entities\peer\RolePeer;
use net\keeko\cms\core\entities\peer\RoleUserPeer;
use net\keeko\cms\core\entities\peer\UserExtValPeer;

/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    net.keeko.cms.core.entities
 */
class User extends \net\keeko\cms\core\entities\base\BaseUser {

	/**
	 * Predefined constants for extended user fields
	 */
	const ICQ = 'icq';
	const MSN = 'msn';
	const JABBER = 'jabber';
	const SKYPE = 'skype';
	// ... more to come here

	/**
	 * Caches values of extended user fields
	 *
	 * @access		private
	 */
	private $extMap = array();

	/**
	 * This means the user is authenticated and authorized.
	 *
	 * Authenticated: The user is known as the user
	 * Authorized: The user proofed his identitiy!
	 *
	 * @access private
	 */
	private $authorized = false;
	private $adminAuthorized = false;

	private $guest = false;

	private $groups = array();
	private $userGroup;
	public $permissionsTable = array();

	/**
	 * Initializes internal state of User object.
	 */
	public function __construct($isGuest = false) {
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();

		$this->guest = $isGuest;
	}

	/**
	 * Retrieve the value of an extended user field
	 *
	 * @param		keyname the keyname to request the value for
	 * @return		mixed
	 */
	public function getExtended($keyname) {
		if (!array_key_exists($keyname, $this->extMap)) {
			$x = UserExtValPeer::retrieveByPK($keyname, $this->getId());
			$this->extMap[$keyname] = $x->getValue();
		}

		return $this->extMap[$keyname];
	}

	public function getGroups() {
		return $this->groups;
	}

	public function getUsergroup() {
		return $this->userGroup;
	}

	public function isAdminAuthorized() {
		return $this->adminAuthorized;
	}

	public function isAuthorized() {
		return $this->authorized;
	}

	public function isGuest() {
		return $this->guest;
	}

	public function save(PropelPDO $con = null) {
		if (!$this->guest) {
			parent::save($con);
		}
	}

	public function setAuthorized($authorized) {
		$this->authorized = $authorized;
	}

	public function setAdminAuthorized($authorized) {
		$this->adminAuthorized = $authorized;
	}

	/**
	 * Saves a value to a keyname of an extended user field
	 *
	 * @param		keyname the keyname to be saved
	 * @param		value the new value
	 * @return		void
	 */
	public function setExtended($keyname, $value) {
		$x = UserExtValPeer::retrieveByPK($keyname, $this->getId());
		$x->setValue($value);
		$x->save();

		$this->extMap[$keyname] = $value;
	}

	private function readGroups() {
		if ($this->guest) {
			$c = new \Criteria();
			$c->add(RolePeer::IS_GUEST, 1);
			$this->groups = RolePeer::doSelect($c);
		} else {
			$c = new \Criteria();
			$c->add(RolePeer::USER_ID, $this->getId());
			$this->userGroup = RolePeer::doSelectOne($c);

			$c = new \Criteria();
			$c->addJoin(RolePeer::ID, RoleUserPeer::ROLE_ID, \Criteria::INNER_JOIN);
			$this->groups = RolePeer::doSelect($c);
		}
	}

	private function readPermissions() {
		$groups = $this->groups;
		if ($this->userGroup) {
			$groups[] = $this->userGroup;
		}

		// collecting ids
		$ids = array();
		foreach ($groups as $group) {
			$actions = $group->getRoleActions();
			foreach ($actions as $groupAction) {
				$ids[] = $groupAction->getActionId();
			}
		}

		// fetching actions
		$ids = array_unique($ids);
		$c = new \Criteria();
		$c->add(ActionPeer::ID, $ids, \Criteria::IN);
		$actions = ActionPeer::doSelect($c);
		foreach($actions as $action) {
			$this->permissionsTable[$action->getModuleId()][$action->getId()] = $action;
			$this->permissionsTable[$action->getModuleId()][$action->getName()] = $action;
		}
	}

	public function updatePermissions() {
		$this->readGroups();
		$this->readPermissions();
	}

	public function hasPermission($moduleId, $action) {
		return array_key_exists($moduleId, $this->permissionsTable)
			&& array_key_exists($action, $this->permissionsTable[$moduleId]);
	}

	public function toXML() {
		$doc = new \DOMDocument('1.0');
		$user = $doc->createElement('user');
		$user->setAttribute('id', $this->getId());
		$user->setAttribute('name', $this->getName());
		$user->setAttribute('isguest', $this->guest ? 'true' : 'false');
		$doc->appendChild($user);

		return $doc;
	}

} // net\keeko\cms\core\entities\User
