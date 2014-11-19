<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $name = 'Users';

	/**
	 * Make sure to define which functions don't require auth to be accessed
	 *
	 * @return void
	 */
	public function beforeFilter() {
		//$this->Auth->allow('usernameExists', 'forgotPassword', 'signup', 'login', 'logout');
		$this->Auth->allow('login', 'logout');
		parent::beforeFilter();
	}

	/**
	 * Login action
	 * - Check credentials
	 *
	 * @return void
	 */
	public function login() {
		$this->layout = 'default';
		$user = $this->model('User');
		$user->logout();

		// append css and js
		//$this->setAssetsLogin();
		//$this->setAssets();

		if (!$this->request->is('post')) {
			return;
		}

		$strUsername = $this->request->data('Users.username');
		$strPassword = $this->request->data('Users.password');
		$boolStatus = $user->login($strUsername, $strPassword);

		if ($boolStatus == true) {
			$strUrl = $this->Auth->redirect();
			return $this->redirect($strUrl);
		} else {
			$this->Session->setFlash(
				__('Username or password is incorrect'), 'default', array('class' => 'alert alert-danger'), 'auth'
			);
			$strUrl = $this->Auth->logout();
			return $this->redirect($strUrl);
		}
	}

	/**
	 * Logout
	 * - Detroy user sesion
	 *
	 * @return void
	 */
	public function logout() {
		//$this->log("Destroying session", 'debug');
		$this->model('User')->logout();
		//$strUrl = $this->Auth->logout();
		$strUrl = $this->Auth->redirect();
		$this->redirect($strUrl);
	}

}
