<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 30.11.2014
 * Time: 12:23
 */


App::uses('AppController', 'Controller');

/**
 * Class LinksController
 *
 * @property AppModel $Link
 */
class LinksController extends AppController {
	public $strActiveNavbar = 'links';

	public function index() {
		$this->setAssetsIndex();
		$this->setAssets();
		$this->set('title_for_layout', __('Links'));
	}

	public function setAssetsIndex() {
		$arrAssets = array();
		$arrAssets['js'][] = array(
			'path' => 'pages/Links/index',
			'options' => array(
				'block' => 'script',
				'inline' => 'true'
			)
		);
		$this->addAssets($arrAssets);
	}

	public function loadIndex($params = array()) {
		$arrReturn = array(
			'links' => $this->Link->getAll()
		);
		return $arrReturn;
	}

	public function loadEdit($params = array()) {
		$return = array();
		$linkId = $params['id'];
		$link = $this->Link->getById($linkId);

		$return['status'] = '1';
		$return['link'] = $link;
		return $return;
	}

	public function getText() {
		$return = array(
			'link' => __('Link'),
			'links' => __('Links'),
			'Do you really want to delete this link?' => __('Do you really want to delete this link?')
		);
		return $return;
	}

	public function deleteLink($params = array()) {
		$return = $this->Link->deleteById($params['id']);
		return $return;
	}

	public function saveLink($params) {
		$return = array();
		$result = $this->Link->saveLink($params);
		if (isset($result['Link']['id'])) {
			$load = array();
			$load['id'] = $result['Link']['id'];
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
		$this->set('title_for_layout', __('Create new web link'));
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
		$this->set('title_for_layout', __('Edit Link'));
	}

	public function setAssetsEdit() {
		$assets = array();
		$assets['js'][] = array(
			'path' => 'pages/Links/edit',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);
		$this->addAssets($assets);
	}

}
