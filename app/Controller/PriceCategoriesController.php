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
class PriceCategoriesController extends AppController
{
	public $strActiveNavbar = 'price_category';

	public function index()
	{
		$this->setAssetsIndex();
		$this->setAssets();
		$this->set('title_for_layout', __('Price Category'));
	}

	public function setAssetsIndex()
	{
		$assets = array();
		$assets['js'][] = array(
			'path' => 'pages/PriceCategories/index',
			'options' => array(
				'block' => 'script',
				'inline' => 'true'
			)
		);
		$this->addAssets($assets);
	}

	public function loadIndex($params = array())
	{
		$arrReturn = array(
			'priceCategories' => $this->PriceCategory->getAll()
		);
		return $arrReturn;
	}

	public function loadEdit($params = array())
	{
		$return = array();
		$id = $params['id'];
		$priceCategory = $this->PriceCategory->getById($id);

		$return['status'] = '1';
		$return['priceCategory'] = $priceCategory;
		return $return;
	}

	public function getText()
	{
		$return = array(
			'Price Category' => __('Price Category'),
			'Price Categories' => __('Price Categories'),
			'Do you really want to delete this price category?' => __('Do you really want to delete this price category?')
		);
		return $return;
	}

	public function deletePriceCategory($params = array())
	{
		$return = $this->PricCategory->deleteById($params['id']);
		return $return;
	}

	public function savePriceCategory($params)
	{
		$return = array();
		$result = $this->PriceCategory->savePriceCategory($params);
		if (isset($result['PriceCategory']['id'])) {
			$load = array();
			$load['id'] = $result['PriceCategory']['id'];
			$return = $this->loadEdit($load);
		} else {
			throw new Exception(__('Error: Object could not be saved'));
		}
		return $return;
	}

	public function add()
	{
		$this->view = 'edit';
		$this->setAssetsEdit();
		$this->setAssets();
		$this->set('title_for_layout', __('Create new price category'));
	}


	/**
	 * Edit action
	 *
	 * @return void
	 * @throws NotFoundException
	 */
	public function edit()
	{
		$this->setAssetsEdit();
		$this->setAssets();

		$id = $this->request->query('id');
		$this->set('title_for_layout', __('Edit Price Category'));
	}

	/**
	 *
	 */
	public function setAssetsEdit()
	{
		$assets = array();
		$assets['js'][] = array(
			'path' => 'pages/PriceCategories/edit',
			'options' => array(
				'block' => 'script',
				'inline' => true
			)
		);
		$this->addAssets($assets);
	}

}
