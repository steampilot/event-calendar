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
		$genreId = $params['id'];
		$genre = $this->Show->getById($genreId);

		$return['status'] = '1';
		$return['genre'] = $genre;
		return $return;
	}

	public function getText() {
		$return = array(
			'genre' => __('Genre'),
			'genres' => __('Genres'),
			'Do you really want to delete this genre?' => __('Do you really want to delete this genre?')
		);
		return $return;
	}

	public function deleteGenre($params = array()) {
		$return = $this->Genre->deleteById($params['id']);
		return $return;
	}

	public function saveGenre($params) {
		$return = array();
		$result = $this->Genre->saveGenre($params);
		if (isset($result['Genre']['id'])) {
			$load = array();
			$load['id'] = $result['Genre']['id'];
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
		$this->set('title_for_layout', __('Create new genre'));
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
		//$strToken = $this->request->query('token');


		//$arrCustomer = $this->Customer->getById($numId);
		//$this->set('customer', $arrCustomer);
		$this->set('title_for_layout', __('Edit article'));
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
