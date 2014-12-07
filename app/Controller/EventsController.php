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
 */
class EventsController extends AppController
{

	/**
	 * Allows unauthenticated access to program and archive
	 *
	 * @return void
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('program', 'archive');
	}


	/**
	 * Shows the upcoming events
	 *
	 * @return void
	 */
	public function program()
	{

	}

	/**
	 * Shows the admin dashboard
	 */
	public function admin_dashboard()
	{
		$this->setAssetsAdminDashboard();
		$this->setAssets();
	}

	/**
	 * Set assets for dashboard action
	 *
	 * @return void
	 */
	public function setAssetsAdminDashboard()
	{
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
