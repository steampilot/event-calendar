<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController
{

	public $name = 'Users';

	/**
	 * Make sure to define which functions don't require auth to be accessed
	 *
	 * @return void
	 */
	public function beforeFilter()
	{
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
	public function login()
	{
		$this->layout = 'default';
		$user = $this->model('User');
		$user->logout();

		// append css and js
		$this->setAssetsLogin();
		$this->setAssets();

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
	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}

	/**
	 * Returns assets for page action
	 *
	 * @return array
	 */
	public function setAssetsLogin()
	{
		$arrAssets = array();

		$strCi = $this->getCi();

		// append ci login.css
		$strBackgroundImg = '';
		if ($this->isValidCi($strCi)) {
			$strBackgroundImg = $this->getBackgroundImage($strCi);
		}

		$arrAssets['js'][] = array(
			'path' => 'login',
			'options' => array(
				'block' => 'script',
				'inline' => true,
				'id' => 'js_login',
				'data-img' => $strBackgroundImg)
		);

		$arrAssets['css'][] = array(
			'path' => 'default/login',
			'options' => array('inline' => false)
		);

		// if ($this->isValidCi($strCi)) {
		//	$arrReturn['css'][] = array(
		//		'path' => $strCi . '/login',
		//		'options' => array('inline' => false)
		//	);
		// }

		$this->addAssets($arrAssets);
	}

	/**
	 * Append assets to layout
	 *
	 * @return void
	 */
	public function setAssets()
	{
		parent::setAssets();
		$this->set('strNavbar', 'navbar_empty');
	}

}
