<?php

App::uses('AppModel', 'Model');

/**
 * Genre Model
 *
 * @property Event $Event
 */
class Genre extends AppModel {
	public function getAll(){
		$return = array();
		$conditions = array();
		$rows =$this->queryFind('all', array(
			'fields' => array('id'),
			'conditions' => $conditions,
			'order' => array('title')
		));
		if (!empty($rows)){
			foreach ($rows as $row) {
				$return[] = $this->getById($row['id']);
			}
		}
		return $return;
	}
	public function getAllActive(){
		$return = array();
		$conditions = array(
			'active' => 1,
		);
		$rows =$this->queryFind('all', array(
			'fields' => array('id'),
			'conditions' => $conditions,
			'order' => array('title')
		));
		if (!empty($rows)){
			foreach ($rows as $row) {
				$return[] = $this->getById($row['id']);
			}
		}
		return $return;
	}

	public function getById($id){
		if(!$this->existValue($id)) {
			throw new Exception(__('Not found'));
		}
		$conditions =array('AND' => array(
			array('id' => $id),
		));
		$row = $this->queryFindRow('all', array(
			'conditions' => $conditions,
		));
		if(empty($row)){
			return array();
		}
		// Convert boolean if neccessary
		return $row;
	}
	public function saveGenre($params){
		$return = array();
		if(empty($params['data']['id'])) {
			$return = $this->insertrow($this->name, $params['data']);
		} else {
			$return = $this->save($params['data'],false);
		}
		return $return;
	}
	public function insertGenre($row){
		$return = array(
			'status' => 0
		);
	}

	public function disableById($id){
		$return = array(
			'status' => 0
		);
		if(!$this->exists($id)) {
			throw new Exception(__('Not found'));
		}
		$this->id = $id;
		$row = array(
			'active' => 0
		);
		$data = $this->save($row, false);
		$return['status'] = 1;
		$return['data'] = $data;
		return $return;
	}
	public function searchGenres($arrPararms) {
		$return = null;
		return $return;
	}
	public function validateGenreUpdate($row) {
		$return = null;
		return $return;
	}

	public function validateGenreInsert($row) {
		$return = null;
		return $return;
	}
}
