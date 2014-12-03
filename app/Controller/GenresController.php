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
class GenresController extends AppController {
	public $strActiveNavbar = 'genre';

	public function index() {
		$this->setAssetsIndex();
		$this->setAssets();
		$this->set('title_for_layout',__('Genre'));
	}
	public function setAssetsIndex() {
		$arrAssets = array();
		$arrAssets['js'][] = array(
			'path' => 'pages/genres/index',
			'options' => array(
				'block' => 'script',
				'inline' => 'true'
			)
		);
		$this->addAssets($arrAssets);
	}

	public function loadIndex($params = array()) {
		$arrReturn = array(
			'genres' => $this->Genre->getAll()
		);
		return $arrReturn;
	}
	public function loadEdit($params = array()) {
		$arrReturn = array();
		$numGenreId = $params['id'];
		$arrGenre = $this->Genre->getById($numGenreId);

		$arrReturn['status'] = '1';
		$arrReturn['genre'] = $arrGenre;
		return $arrReturn;
	}
	public function getText(){
		$return = array(
			'Genre'=> __('Genre'),
			'Genres' => __('Genres'),
			'Do you really want to delete this genre?' => __('Do you really want to delete this genre?')
		);
		return $return;
	}
	public function deleteGenre($params = array()){
		$return = $this->Genre->deleteById($params['id']);
		return $return;
	}

	public function saveGenre($params){
		$return = array();
		$result = $this->Genre->saveGenre($params);
		if(isset($result['Genre']['id'])){
			$load = array();
			$load['id'] = $result['Genre']['id'];
			//$load['token'] = $result['genre']['token'];
			$return = $this->loadEdit($load);
		} else {
			throw new Exception(__('Error: Object could not be saved'));
		}
		return $return;
	}
	public function add(){
		$this->view = 'edit';
		$this->setAssetsEdit();
		$this->setAssets();
		$this->set('title_for_layout',__('Create new genre'));
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

	/**
	 *
	 */
	public function setAssetsEdit(){
		$assets = array();
		$assets['js'][] = array(
			'path' => 'pages/genres/edit',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);
		$this->addAssets($assets);
	}

}
