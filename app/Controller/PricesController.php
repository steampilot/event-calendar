<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 30.11.2014
 * Time: 12:23
 */


App::uses('AppController', 'Controller');

/**
 * Class PricesController
 *
 */
class PricesController extends AppController {
	public $strActiveNavbar = 'prices';

	public function index() {
		$this->setAssetsIndex();
		$this->setAssets();
		$this->set('title_for_layout', __('Ticket Prices'));
	}

	public function setAssetsIndex() {
		$arrAssets = array();
		$arrAssets['js'][] = array(
			'path' => 'pages/Prices/index',
			'options' => array(
				'block' => 'script',
				'inline' => 'true'
			)
		);
		$this->addAssets($arrAssets);
	}

	public function loadIndex($params = array()) {
		$arrReturn = array(
			'prices' => $this->Price->getAll()
		);
		return $arrReturn;
	}

	public function loadEdit($params = array()) {
		$return = array();
		$priceId = $params['id'];
		$price = $this->Price->getById($priceId);

		$return['status'] = '1';
		$return['price'] = $price;
		return $return;
	}

	public function getText() {
		$return = array(
			'price' => __('Price'),
			'prices' => __('Prices'),
			'Do you really want to delete this price?' => __('Do you really want to delete this price?')
		);
		return $return;
	}

	public function deletePrice($params = array()) {
		$return = $this->Price->deleteById($params['id']);
		return $return;
	}

	public function savePrice($params) {
		$return = array();
		$result = $this->Price->savePrice($params);
		if (isset($result['Price']['id'])) {
			$load = array();
			$load['id'] = $result['Price']['id'];
			$return = $this->loadEdit($load);
		} else {
			throw new Exception(__('Error: Object could not be saved'));
		}
		return $return;
	}

	/**
	 * Adds a new Price
	 *
	 * @todo remove superflous eventId, for it is handled in Event/edit.js
	 *
	 * @param int $eventId
	 */
	public function add($eventId = 0) {
		$this->view = 'edit';
		$this->setAssetsEdit();
		$this->setAssets();
		$numEventId = $this->request->query('eventId');
		$this->set('title_for_layout', __('Create new price'));
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
		$this->set('title_for_layout', __('Edit Price'));
	}

	public function setAssetsEdit() {
		$assets = array();
		$assets['js'][] = array(
			'path' => 'pages/Prices/edit',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);
		$this->addAssets($assets);
	}

}
