<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Component');
	public $components = array(
		'Session',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login',
				'admin' => false
			),
			'loginRedirect' => array('controller' => 'events', 'action' => 'dashboard', 'admin' => true),
			'logoutRedirect' => '/'
		)
	);

	protected $arrAssets = array();

	/* Current active navbar */
	public $strActiveNavbar = null;


	/**
	 * Callback beforeFilter
	 *
	 * @return void
	 */
	public function beforeFilter() {
		// Authentication adapter
		$this->Auth->authenticate = array(
			AuthComponent::ALL => array('userModel' => 'Users'),
			'Basic',
			'Form'
		);

		// If you want to do your authorization from the isAuthorized
		// Controller use the following
		$this->Auth->authorize = array('Controller');

		// bootstrap auth error message
		$this->Auth->flash = array(
			'element' => 'default',
			'params' => array('class' => 'alert alert-danger'),
			'key' => 'auth'
		);

		// set global view variable
		$arrUser = $this->getUser();
		if (!empty($arrUser['info'])) {
			$this->set('userinfo', $arrUser['info']);
		}
	}

	/**
	 * This just says aslong as this is a valid user let them in,
	 * you can also modify this to restrict to a group
	 *
	 * @return boolean
	 */
	public function isAuthorized() {
		$user = $this->getUser();
		if (!empty($user['id'])) {
			return true;
		}
		return false;
	}

	/**
	 * Returns current user
	 *
	 * @return object
	 */
	public function getUser() {
		return $this->Auth->user();
	}

	/**
	 * Handle JSON-RPC 2.0 request and response
	 * http://www.jsonrpc.org/specification
	 *
	 * @return void
	 */
	public function rpc() {
		$this->autoRender = false;
		$this->layout = 'empty';
		$this->response->type('json');
		//throw new NotFoundException();

		$strRequest = $this->request->data('json');
		$arrRequest = decode_json($strRequest);
		$strMethod = $arrRequest['method'];

		$strResponse = '';
		$arrResponse = array();
		$arrResponse['jsonrpc'] = '2.0';
		$arrResponse['id'] = $arrRequest['id'];

		try {
			if (!$this->request->is('ajax')) {
				$arrResponse['error']['message'] = 'Inalid request';
			} else {
				if (method_exists($this, $strMethod)) {
					$reflection = new ReflectionMethod($this, $strMethod);
					if ($reflection->isPublic()) {
						if (isset($arrRequest['params'])) {
							$arrResponse['result'] = $this->{$strMethod}($arrRequest['params']);
						} else {
							$arrResponse['result'] = $this->{$strMethod}();
						}
					} else {
						//throw new RuntimeException("The called method is not public.");
						$arrResponse['error']['message'] = 'Method is not public';
					}
				} else {
					$arrResponse['error']['message'] = 'Method not found';
				}
			}
		} catch (Exception $ex) {
			$arrResponse['error']['message'] = $ex->getMessage();
		}

		$strResponse = encode_json($arrResponse);
		$this->response->body($strResponse);
	}

	/**
	 * Returns object by model classname
	 *
	 * @param string $strModel model name
	 * @return object
	 */
	public function model($strModel) {
		return ClassRegistry::init($strModel);
	}

	/**
	 * Append assets to layout
	 *
	 * @return void
	 */
	public function setAssets() {
		// append css and js
		$arrAssets = array();
		$arrAssets['js'] = $this->getJs();
		$arrAssets['css'] = $this->getCss();

		if (!empty($this->arrAssets['css'])) {
			foreach ($this->arrAssets['css'] as $arrFile) {
				$arrAssets['css'][] = $arrFile;
			}
		}

		if (!empty($this->arrAssets['js'])) {
			foreach ($this->arrAssets['js'] as $arrFile) {
				$arrAssets['js'][] = $arrFile;
			}
		}

		$this->set('arrAssets', $arrAssets);
		$this->set('strLogo', $this->getLogo());
		$this->set('strFavicon', $this->getFavicon());
		$this->set('strActiveNavbar', $this->strActiveNavbar);

		// navigation
		$this->set('strNavbar', 'navbar');

		// CI
		$this->set('ci', $this->getCi());

		// elements
		// $arrElements = array();
		// $arrElements[] = array('name' => $page);
		// $this->set('arrElements', $arrElements);
	}

	/**
	 * Returns current CI from subdomain
	 *
	 * @return string
	 */
	public function getCi() {
		$strCi = 'default';
		return $strCi;
	}

	/**
	 * Returns true if CI is valid
	 *
	 * @param string $strCi ci name (bvb or blt)
	 * @return boolean
	 */
	public function isValidCi($strCi) {
		if ($strCi == 'default') {
			$boolReturn = true;
		} else {
			$boolReturn = false;
		}
		return $boolReturn;
	}

	/**
	 * Returns CI favicon
	 *
	 * @param string $strCi ci name (bvb or blt)
	 * @return string
	 */
	public function getFavicon($strCi = 'default') {
		$strReturn = 'favicon.ico';
		return $strReturn;
	}

	/**
	 * Returns CI favicon
	 *
	 * @param string $strCi ci name (bvb or blt)
	 * @return string
	 */
	public function getLogo($strCi = 'default') {
		$strReturn = sprintf('img/%s/logo.png', $strCi);
		return $strReturn;
	}

	/**
	 * Generate random background image for login screen.
	 * From 00-04 o'clock return sleeping man background image.
	 *
	 * @param string $strCi ci name
	 * @return string
	 */
	public function getBackgroundImage($strCi = 'default') {
		$numNumber = rand(1, 4);
		$strReturn = sprintf('img/%s/login%s.jpg', $strCi, $numNumber);
		$numHour = date('H');
		if ($numHour >= 0 && $numHour <= 4) {
			// show maintenance image
			$strReturn = 'img/login-sleep.jpg';
		}
		return $strReturn;
	}

	/**
	 * Add assets to page
	 *
	 * @param array $arrAssets array of assets
	 * @return void
	 */
	public function addAssets($arrAssets) {
		foreach ($arrAssets as $strKey => $arrAssetItems) {
			foreach ($arrAssetItems as $arrItem) {
				$this->arrAssets[$strKey][] = $arrItem;
			}
		}
	}

	/**
	 * Add asset to page
	 *
	 * @param array $arrAsset asset
	 * @return void
	 */
	public function addAsset($arrAsset) {
		$strKey = key($arrAsset);
		$this->arrAssets[$strKey][] = $arrAsset[$strKey];
	}

	/**
	 * Returns assets for page action
	 *
	 * @param string $strAction action name
	 * @return array
	 */
	public function getPageFiles($strAction) {
		return null;
	}

	/**
	 * Returns global CSS files for view
	 *
	 * @return array
	 */
	public function getCss() {
		$arrReturn = array();
		$strCi = $this->getCi();

		// allways load layout.css
		$arrReturn[] = array(
			'path' => 'default/layout',
			'options' => array('inline' => false)
		);

		// append ci layout.css and login.css
		if ($this->isValidCi($strCi)) {

			$arrReturn[] = array(
				'path' => $strCi . '/layout',
				'options' => array('inline' => false)
			);
		}

		$arrReturn[] = array(
			'path' => 'notifit',
			'options' => array('inline' => false)
		);

		return $arrReturn;
	}

	/**
	 * Returns global JS files for view
	 *
	 * @return array
	 */
	public function getJs() {
		$arrReturn = array();

		$arrReturn[] = array(
			'path' => 'd',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);

		$arrReturn[] = array(
			'path' => 'app',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);

		$arrReturn[] = array(
			'path' => 'notifit',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);

		$arrReturn[] = array(
			'path' => 'pages/layout/layout',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);

		// https://github.com/twbs/bootlint
		// https://raw.githubusercontent.com/twbs/bootlint/master/dist/browser/bootlint.js
		/* $arrReturn[] = array(
		  'path' => 'bootlint',
		  'options' => array(
		  'block' => 'script',
		  'inline' => true
		  )
		  ); */

		return $arrReturn;
	}

}
