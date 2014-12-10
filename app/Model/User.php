<?php
App::uses('AppModel', 'Model');

/**
 * User Model
 *
 */
class User extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'title';

	/**
	 * Default order field
	 *
	 * @var string
	 */
	public $order = "title";

	/**
	 * User login
	 *
	 * @param string $strUsername
	 * @param string $strPassword
	 * @return bool
	 */
	public function login($strUsername, $strPassword) {
		// user lookup in user table
		$arrUser = $this->getUserByLogin($strUsername, $strPassword);

		if (empty($arrUser)) {
			return false;
		}

		$numUserId = $arrUser['id'];
		$strTitle = $arrUser['title'];

		CakeSession::write('Auth.User.id', $numUserId);
		CakeSession::write('Auth.User.username', $strUsername);
		CakeSession::write('Auth.User.title', $strTitle);

		return true;
	}

	/**
	 * Logout user. Clear user session
	 *
	 * @return void
	 */
	public function logout() {
		CakeSession::write('Auth.User.id', null);
		CakeSession::write('Auth.User.username', null);
		CakeSession::write('Auth.User.title', null);
		CakeSession::write('Auth.User', array());
		CakeSession::destroy();
	}

	/**
	 * Returns user by login (username, password)
	 *
	 * @param string $strUsername
	 * @param string $strPassword
	 * @return array
	 */
	public function getUserByLogin($strUsername, $strPassword) {
		$arrConditions = array('AND' => array(
			'username' => $strUsername,
		));
		$arrReturn = $this->queryFindRow('all', array(
			'conditions' => $arrConditions,
		));
		$strHash = $arrReturn['password'];
		$boolStatus = $this->verifyHash($strPassword, $strHash);
		if (!$boolStatus) {
			$arrReturn = null;
		}
		return $arrReturn;
	}

	/**
	 * Returns true if password and hash is valid
	 *
	 * @param string $strPassword
	 * @param string $strHash
	 * @return bool
	 */
	function verifyHash($strPassword, $strHash) {
		if (function_exists('password_verify')) {
			// php >= 5.5
			$boolReturn = password_verify($strPassword, $strHash);
		} else {
			$strHash2 = crypt($strPassword, $strHash);
			$boolReturn = $strHash == $strHash2;
		}
		return $boolReturn;
	}

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Feld muss ausgefüllt sein',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'naturalNumber' => array(
				'rule' => array('naturalNumber'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Erlaubte Zeichen: a-z, A-Z 0-9',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength'),
				'message' => 'Erlaubte Zeichenlänge: 45',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Erlaubte Zeichen: a-z, A-Z 0-9',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email erforderlich: name@domain.ch',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength'),
				'message' => 'Maximale Zeichenlänge: 45',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Dieses Feld muss ausgefüllt sein',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Dieses Feld muss ausgefüllt sein',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'created' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'created_by' => array(
			'naturalNumber' => array(
				'rule' => array('naturalNumber'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'modified' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'modified_by' => array(
			'naturalNumber' => array(
				'rule' => array('naturalNumber'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
