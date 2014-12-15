<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 03.12.2014
 * Time: 17:12
 */


App::uses('AppController', 'Controller');

/**
 * Events Controller
 *
 * @property Event Event
 *
 */
class EventsController extends AppController {
	public $strActiveNavbar = 'Event';

	/**
	 * Allows unauthenticated access to program and archive
	 *
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('program', 'archive');
	}
	public function index() {
		$this->setAssetsIndex();
		$this->setAssets();
		$this->set('title_for_layout', __('Event'));
	}
	public function setAssetsIndex() {
		$arrAssets = array();
		$arrAssets['js'][] = array(
			'path' => 'pages/Events/index',
			'options' => array(
				'block' => 'script',
				'inline' => 'true'
			)
		);
		$this->addAssets($arrAssets);
	}
	public function loadIndex($params = array()) {
		$arrReturn = array(
			'events' => $this->Event->getAll()
		);
		return $arrReturn;
	}
	public function loadEdit($params = array()) {
		$result = array();
		$eventId = $params['id'];
		$event = $this->Event->getById($eventId);
		$prices = $this->model('Price')->getByEventId($eventId);
		$shows = $this->model('Show')->getByEventId($eventId);
		$links = $this->model('Link')->getByEventId($eventId);
		$result['status'] = '1';
		$result['event'] = $event;
		$result['prices'] = $prices;
		$result['shows'] = $shows;
		$result['links'] =$links;
		return $result;
	}

	public function getText() {
		$return = array(
			'event' => __('Event'),
			'events' => __('Events'),
			'Do you really want to delete this event?' => __('Do you really want to delete this event?')
		);
		return $return;
	}

	public function deleteEvent($params = array()) {
		$return = $this->Event->deleteById($params['id']);
		return $return;
	}

	public function saveEvent($params) {
		$return = array();
		$result = $this->Event->saveEvent($params);
		if (isset($result['Event']['id'])) {
			$load = array();
			$load['id'] = $result['Event']['id'];
			$return = $this->loadEdit($load);
		} else {
			throw new Exception(__('Error: Object could not be saved'));
		}
		return $return;
	}

	public function add() {
		$this->view = 'edit';
		$this->setAssetsEdit();
		$this->setAssets();
		$this->set('title_for_layout', __('Create new event'));
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
		$this->set('title_for_layout', __('Edit Event'));
	}

	public function setAssetsEdit() {
		$assets = array();
		$assets['js'][] = array(
			'path' => 'pages/Events/edit',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);
		$this->addAssets($assets);
	}


	/**
	 * Shows the upcoming events
	 *
	 * @return void
	 */
	public function program() {
		$events = $this->Event->find('all');
		$this->set('events' , $events);

	}

	/**
	 * Shows the admin dashboard
	 */
	public function admin_dashboard() {
		$this->setAssetsAdminDashboard();
		$this->setAssets();
	}

	/**
	 * Set assets for dashboard action
	 *
	 * @return void
	 */
	public function setAssetsAdminDashboard() {
		$arrAssets = array();

		$arrAssets['js'][] = array(
			'path' => 'Chart.min',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);

		$arrAssets['js'][] = array(
			'path' => 'pages/index/index',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);

		$this->addAssets($arrAssets);
	}

}
