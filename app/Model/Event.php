<?php
App::uses('AppModel', 'Model');

/**
 * Event Model
 *
 * @property Genre $Genre
 * @property Link $Link
 * @property Price $Price
 * @property Show $Show
 */
class Event extends AppModel {


	public function getAll() {
		$return = array();
		$conditions = array(
			'deleted' => 0,
		);
		$rows = $this->queryFind('all', array(
			'fields' => array('id'),
			'conditions' => $conditions,
			'order' => array('title')
		));
		if (!empty($rows)) {
			foreach ($rows as $row) {
				$return[] = $this->getById($row['id']);
			}
		}
		return $return;
	}

	public function getById($id) {
		if (!$this->existValue($id)) {
			throw new Exception(__('Not found'));
		}
		$conditions = array('AND' => array(
			array('id' => $id),
		));
		$row = $this->queryFindRow('all', array(
			'conditions' => $conditions,
		));
		if (empty($row)) {
			return array();
		}
		// Convert boolean if neccessary
		return $row;
	}

	public function saveEvent($params) {
		$return = array();
		if (empty($params['data']['id'])) {
			$return = $this->insertRow($this->name, $params['data']);
		} else {
			$return = $this->save($params['data'], false);

		}
		return $return;
	}

	public function deleteById($id) {
		$return = array(
			'status' => 0
		);
		if (!$this->exists($id)) {
			throw new Exception(__('Not found'));
		}
		$this->id = $id;
		$row = array(
			'deleted' => 1
		);
		$data = $this->save($row, false);
		$return['status'] = 1;
		$return['data'] = $data;
		return $return;
	}

	public function searchEvents($arrPararms) {
		$return = null;
		return $return;
	}

	public function validateEventsUpdate($row) {
		$return = null;
		return $return;
	}

	public function validateEventsInsert($row) {
		$return = null;
		return $return;
	}

}
