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
			//'loginRedirect' => array('controller' => 'contact', 'action' => 'index'),
			'loginRedirect' => array('controller' => 'pages', 'action' => 'index'),
			//'logoutRedirect' => array('controller' => 'users', 'action' => 'logout'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
		)
	);

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

}
