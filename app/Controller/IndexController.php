<?php
/**
 * Created by PhpStorm.
 * User: steampilot
 * Date: 24.11.14
 * Time: 09:21
 */

App::uses('AppController', 'Controller');

class IndexController extends AppController {

    public $strActiveNavbar = 'dashbaord';

    /**
     * Action: index
     *
     * @return void
     */
    public function index() {
        $this->setAssetsIndex();
        $this->setAssets();
    }

    /**
     * Set assets for index action
     *
     * @return void
     */
    public function setAssetsIndex() {
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