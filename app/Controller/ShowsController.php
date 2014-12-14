<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 30.11.2014
 * Time: 12:23
 */


App::uses('AppController', 'Controller');

/**
 * Class GenresController
 *
 */
class ShowsController extends AppController {
	public $strActiveNavbar = 'shows';

	public function index() {
		$this->setAssetsIndex();
		$this->setAssets();
		$this->set('title_for_layout', __('Shows'));
	}

	public function setAssetsIndex() {
		$arrAssets = array();
		$arrAssets['js'][] = array(
			'path' => 'pages/Shows/index',
			'options' => array(
				'block' => 'script',
				'inline' => 'true'
			)
		);
		$this->addAssets($arrAssets);
	}

	public function loadIndex($params = array()) {
		$arrReturn = array(
			'shows' => $this->Show->getAll()
		);
		return $arrReturn;
	}

	public function loadEdit($params = array()) {
		$return = array();
		$showId = $params['id'];
		$show = $this->Show->getById($showId);

		$return['status'] = '1';
		$return['show'] = $show;
		return $return;
	}

	public function getText() {
		$return = array(
			'show' => __('Show'),
			'shows' => __('Shows'),
			'Do you really want to delete this show?' => __('Do you really want to delete this show?')
		);
		return $return;
	}

	public function deleteShow($params = array()) {
		$return = $this->Show->deleteById($params['id']);
		return $return;
	}

	public function saveShow($params) {
		$return = array();
		$result = $this->Show->saveShow($params);
		if (isset($result['Show']['id'])) {
			$load = array();
			$load['id'] = $result['Show']['id'];
			$return = $this->loadEdit($load);
		} else {
			throw new Exception(__('Error: Object could not be saved'));
		}
		return $return;
	}

	public function add($eventId = 0) {
		$this->view = 'edit';
		$this->setAssetsEdit();
		$this->setAssets();
		$numEventId = $this->request->query('eventId');
		$this->set('title_for_layout', __('Create new show'));
	}


	/**
	 * Edit action
	 *
	 * @return void
	 * @throws NotFoundException
	 */
	public function edit() {
		$this->setAssetsEdit();
		$this->setAssets();

		$numId = $this->request->query('id');
		$this->set('title_for_layout', __('Edit Show'));
	}

	public function setAssetsEdit() {
		$assets = array();
		$assets['js'][] = array(
			'path' => 'pages/Genres/edit',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);
		$this->addAssets($assets);
	}

}
